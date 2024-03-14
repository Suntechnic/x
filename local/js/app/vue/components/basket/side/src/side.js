import {Basket,BasketItem,BasketItemDel} from 'app.vue.components.basket.mixin';
import {Grammar} from 'x.util';

export const BasketSideItem = {
	mixins: [BasketItem,BasketItemDel],
	template: /* vue-html */`
    <div class="product-basket">
        <div class="product-basket__preview" v-if="product">
            <img v-if="product.PICTURE" v-bind:src="product.PICTURE.SRC" alt="" loading="lazy">
        </div>
        <div class="product-basket__main">
            <div class="product-basket__name">
                {{item.name}}
            </div>
            <div class="product-basket__size" v-for="prop in item.properties">
                {{prop.NAME}}: {{prop.VALUE}}
            </div>
            <div class="row align-items-center">
                <div class="col">
                    <div class="cart-product__quantity-field">
                        <div class="quantity-field__minus" v-on:click="requant(-1)"></div>
                        <input type="text" v-model="item.quantity" class="quantity-field__input" disable>
                        <div class="quantity-field__plus" v-on:click="requant(1)"></div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="product-basket__price" v-html="item.sumformated"></div>
                </div>
            </div>
        </div>
    </div>
	`
};

export const BasketSide = {
	components: {Item: BasketSideItem},
	mixins: [Basket],
	props: {
		conex: {
			type: Object,
			default: []
		},
		total: {
			type: String,
		}
	},
	computed: {
		itemsNumTitle ()
		{
			if (this.$store.state.basket?.items?.length) {
				return Grammar.declOfNum(this.$store.state.basket.items.length, [
						'товар', // 1 товар
						'товара', // 2 товара
						'товаров' // 10 товаров
					]);
			} else {
				return '';
			}
		}
	},
	watch: {
        hash: { // сообщаем родителю, что корзина изменилась
            handler(val, oval) {
                if (val && val != oval) {
                    this.$emit('basketchange',val)
                }
            }
        }
    },
	template: /* vue-html */`
    <div class="baskets-main">
        <div class="list-baskets">
            <Item v-for="item in items" v-bind:key="item.id" v-bind:item="item" v-bind:product="products[item.productid]"></Item>
        </div>
        
        <form class="discount-form">
            <div class="promocode" v-for="coupon in coupons">
                Used coupon: {{coupon}} <button v-on:click.stop.prevent="deleteCoupon(coupon)">Delete</button>
            </div>
            <input type="text" placeholder="Discount code or gift card" v-model="form.coupon">
            <button v-on:click.stop.prevent="applyCoupon"></button>
        </form>
        <div class="baskets-info">
            <div class="row mb-2">
                <div class="col">Subtotal</div>
                <div class="col-auto" v-html="sumbaseFormated"></div>
            </div>
            <div class="row mb-1" v-for="con in conex">
                <div class="col">
                    {{con.title}}
                </div>
                <div class="col-auto">
                    <strong v-html="con.priceformated"></strong>
                </div>
            </div>
            <div class="row total-price-basket" v-if="total?.ORDER_TOTAL_PRICE_FORMATED">
                <div class="col">Total</div>
                <div class="col-auto"><strong v-html="total.ORDER_TOTAL_PRICE_FORMATED"></strong></div>
            </div>
        </div>

    </div>
	`
};