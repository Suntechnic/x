import {Currency} from 'currency';
import {iziToast} from 'x.izi';


export const Basket = {
    data () {
		return {
			products: {},
            state: {
				showcouponform: false,
				waitproducts: false
			},
			form: {
				coupon: ''
			}
		};
	},
	computed: {
        basket () {
            return this.$store.state.basket
        },
		items ()
		{
			return this.$store.state.basket?.items;
		},
        hash ()
        {
            return this.$store.state.basket?.hash;
        },
        /**
         * карта IdItem'аКоризны => IndexВСписке
         */
		map ()
		{
			let map = {};
			for (let i in this.items) {
				map[this.items[i].id] = i;
			}
			return map;
		},
		sum ()
		{
			return this.$store.state.basket?.sum;
		},
		sumbase ()
		{
			let sumbase = 0;
			if (this.products) {
                for (let i in this.items) {
					let item = this.items[i];
					let pricebase = item.price;
                    if (this.products[item.productid]?.PRICE?.BASE
							&& this.products[item.productid].PRICE.BASE > item.price
						) {
                        pricebase = this.products[item.productid]?.PRICE?.BASE;
                    }
					sumbase = sumbase + pricebase*item.quantity;
                }
            }
			return sumbase;
		},
		sumFormated ()
		{
			return Currency.currencyFormat(
                    this.sum,
                    'USD',
                    true
                );
		},
		sumbaseFormated ()
		{
			return Currency.currencyFormat(
                            this.sumbase,
                            'USD',
                            true
                        );
		},
        coupons ()
        {
            if (this.$store.state.basket?.coupons?.length) return this.$store.state.basket.coupons;
            return [];
        }
	},
    methods: {
		toggleCouponForm () {
			this.state.showcouponform = !this.state.showcouponform;
		},
		closeCouponForm () {
			this.state.showcouponform = false;
		},
		applyCoupon () {
			let couponCode = this.form.coupon;
			if (couponCode && couponCode.length > 3) {
				BX.ajax.runAction('x:api.app.controller.applyCoupon', {data:{
						coupon: couponCode
					}})
					.then((response) => {
						
					}, (response) => {
						console.log(response);
					});
                let data = {
                        coupon: couponCode,
                        sessid: BX.bitrix_sessid()
                    };
                BX.ajax.post(
                        '/api/basket/coupon/add',
                        data,
                        (response) => {
                            response = JSON.parse(response);

                            if (response.data) {
                                this.$store.dispatch('update',{key:'basket', data:response.data});
                                this.$nextTick(()=>{
                                    for (let i in this.coupons) {
                                        if (this.coupons[i] == couponCode) {
                                            iziToast.success({
                                                    timeout: 2000,
                                                    //title: 'Ошибка', 
                                                    message: 'The coupon '+couponCode+' has been successfully applied'
                                                });
                                            this.form.coupon = '';
                                            this.closeCouponForm();
                                            return;
                                        }
                                    }
                                    iziToast.error({
                                            timeout: 6000,
                                            title: 'Error', 
                                            message: 'The coupon '+couponCode+' was not applied.<br>Check the code or try again later.'
                                        });
                                });
                            }
                        }
                    );

			}
		},
        deleteCoupon (couponCode) {
			if (couponCode && couponCode.length > 3) {
                let data = {
                        coupon: couponCode,
                        sessid: BX.bitrix_sessid()
                    };
                BX.ajax.post(
                        '/api/basket/coupon/del',
                        data,
                        (response) => {
                            response = JSON.parse(response);

                            if (response.data) {
                                this.$store.dispatch('update',{key:'basket', data:response.data});
                            }
                        }
                    );

            }
		},
        /**
         * подгрузка информации о товарах в корзние
         */
		updateProducts () {
			if (this.items?.length) {
				let id4update = [];
                for (let i in this.items) {
					let id = this.items[i].productid;
                    if (!this.products[id]) {
						id4update.push(id);
                    }
                }

				if (id4update.length) {

					if (this.state.waitproducts) {
						return;
					}
					this.state.waitproducts = true;

                    let data = {
                            id: id4update,
                            sessid: BX.bitrix_sessid()
                        };
                    
                    BX.ajax.post(
                            '/catalog/products',
                            data,
                            (response) => {
                                response = JSON.parse(response);

                                if (response.data) {
                                    for (let id in response.data) {
                                        this.products[id] = response.data[id];
                                    }
                                }
                                this.state.waitproducts = false;
                            }
                        );

                }
            }
		}
	},
	mounted () {
		this.updateProducts();
	},	
	watch: {
		items (items)
		{
			this.updateProducts();
		}
	},
}

// Миксин метода удаления товара из козины
// расчитывает на item в компоненте
export const BasketItemDel = {
	methods: {
		del ()
		{
			if (this.state) return;
			let item = this.item;
			this.state = 'delete';

            let data = {
                    id: this.item.id,
                    sessid: BX.bitrix_sessid()
                };

            BX.ajax.post(
                    '/api/basket/del',
                    data,
                    (response) => {
                        response = JSON.parse(response);

                        if (response.data) {
                            //BX.onCustomEvent('OnBasketRemoveProduct', {item: item});
                            this.$store.dispatch('update',{key:'basket', data:response.data});
                        }
                        this.state = false;
                    }
                );
		},
    }
}

// item корзины
export const BasketItem = {
    mixins: [BasketItemDel],
    props: {
		item: {

		},
		product: {

		}
	},
	data () {
		return {
			state: false
		};
	},
	computed: {
		pricebase ()
		{
			if (this.product?.PRICE?.BASE) return this.product.PRICE.BASE
			return this.item.price;
		},
		pricebaseformated ()
		{
			if (this.product?.PRICE?.BASE_FORMATED) return this.product.PRICE.BASE_FORMATED
			return Currency.currencyFormat(
                            this.pricebase,
                            'USD',
                            true
                        );
		},
		sumbase ()
		{
			return this.pricebase*this.item.quantity
		},
		sumbaseformated ()
		{
			return Currency.currencyFormat(
					this.sumbase,
					'USD',
					true
				);
		},
		discount ()
		{
			if (this.sumbase && this.sumbase > this.item.sum) {
                return this.sumbase - this.item.sum;
            }
			return 0;
		},
		discountpercent ()
		{
			return Math.ceil(this.discount/this.sumbase*100);
		},
		available ()
		{
			return (this.product?.CATALOG_AVAILABLE == 'Y' && parseInt(this.product?.CATALOG_QUANTITY) > 0);
		}
	},
	methods: {
		requant (Δ)
		{
			if (this.state) return;

			let item = this.item;
			this.state = 'requant';

            let data = {
                    id: this.item.id,
                    quantity: item.quantity+Δ,
                    sessid: BX.bitrix_sessid()
                };

            BX.ajax.post(
                    '/api/basket/update',
                    data,
                    (response) => {
                        response = JSON.parse(response);

                        if (response.data) {
                            this.$store.dispatch('update',{key:'basket', data:response.data});
                        }
                        this.state = false;
                    }
                );
		}
    }
}


export const BasketAdd = {
    data()
	{
		return {
            form: {
                offers: {}
            },
            state: {
                exchange: false
            }
		};
	},
	computed: {
		basketItem () {
			if (this.$store.state.basket?.items) {
				for (let i in this.$store.state.basket.items) {

					if (this.$store.state.basket.items[i].productid == this.productid) 
							return this.$store.state.basket.items[i];
				}
			}
			return false; 
		},
		basketItemCnt () {
			if (this.basketItem) return this.basketItem.quantity;
			return 0; 
		},
	},
	methods: {
		changeQnt (OfferId, Δ /* дельа )), да, так можно */) {
            if (!this.form.offers[OfferId]) this.form.offers[OfferId] = 0;
            this.form.offers[OfferId] = this.form.offers[OfferId]+Δ;
            if (this.form.offers[OfferId] < 1) delete this.form.offers[OfferId];
        },
        add ()
        {
            if (this.state.exchange) return;
            this.state.exchange = true;

            let items = [];

            for (let id in this.form.offers) {
                items.push({
                    id: id,
                    quantity: this.form.offers[id]
                });
            }

            //this.form.offers = {}; // сбрасываем

            let data = {
                    lstItems: items,
                    sessid: BX.bitrix_sessid()
                };

            BX.ajax.post(
                    '/api/basket/add',
                    data,
                    (response) => {
                        response = JSON.parse(response);
                        console.log(response);

                        if (response.data) {
                            // document.querySelectorAll('[href="/personal/order/make/"]').forEach((n)=>{
                            //     n.dataset.count = response.data.count
                            // })
                            
                            this.$store.dispatch('update',{key:'basket', data:response.data});
                        }

                        this.state.exchange = false;
                    }
                );
        }
    }
}