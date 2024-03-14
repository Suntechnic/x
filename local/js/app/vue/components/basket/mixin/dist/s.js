/* eslint-disable */
this.BX = this.BX || {};
this.BX.App = this.BX.App || {};
this.BX.App.Vue = this.BX.App.Vue || {};
(function (exports,currency,x_izi) {
    'use strict';

    var Basket = {
      data: function data() {
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
        basket: function basket() {
          return this.$store.state.basket;
        },
        items: function items() {
          var _this$$store$state$ba;
          return (_this$$store$state$ba = this.$store.state.basket) === null || _this$$store$state$ba === void 0 ? void 0 : _this$$store$state$ba.items;
        },
        hash: function hash() {
          var _this$$store$state$ba2;
          return (_this$$store$state$ba2 = this.$store.state.basket) === null || _this$$store$state$ba2 === void 0 ? void 0 : _this$$store$state$ba2.hash;
        },
        /**
         * карта IdItem'аКоризны => IndexВСписке
         */
        map: function map() {
          var map = {};
          for (var i in this.items) {
            map[this.items[i].id] = i;
          }
          return map;
        },
        sum: function sum() {
          var _this$$store$state$ba3;
          return (_this$$store$state$ba3 = this.$store.state.basket) === null || _this$$store$state$ba3 === void 0 ? void 0 : _this$$store$state$ba3.sum;
        },
        sumbase: function sumbase() {
          var sumbase = 0;
          if (this.products) {
            for (var i in this.items) {
              var _this$products$item$p, _this$products$item$p2;
              var item = this.items[i];
              var pricebase = item.price;
              if ((_this$products$item$p = this.products[item.productid]) !== null && _this$products$item$p !== void 0 && (_this$products$item$p2 = _this$products$item$p.PRICE) !== null && _this$products$item$p2 !== void 0 && _this$products$item$p2.BASE && this.products[item.productid].PRICE.BASE > item.price) {
                var _this$products$item$p3, _this$products$item$p4;
                pricebase = (_this$products$item$p3 = this.products[item.productid]) === null || _this$products$item$p3 === void 0 ? void 0 : (_this$products$item$p4 = _this$products$item$p3.PRICE) === null || _this$products$item$p4 === void 0 ? void 0 : _this$products$item$p4.BASE;
              }
              sumbase = sumbase + pricebase * item.quantity;
            }
          }
          return sumbase;
        },
        sumFormated: function sumFormated() {
          return currency.Currency.currencyFormat(this.sum, 'USD', true);
        },
        sumbaseFormated: function sumbaseFormated() {
          return currency.Currency.currencyFormat(this.sumbase, 'USD', true);
        },
        coupons: function coupons() {
          var _this$$store$state$ba4, _this$$store$state$ba5;
          if ((_this$$store$state$ba4 = this.$store.state.basket) !== null && _this$$store$state$ba4 !== void 0 && (_this$$store$state$ba5 = _this$$store$state$ba4.coupons) !== null && _this$$store$state$ba5 !== void 0 && _this$$store$state$ba5.length) return this.$store.state.basket.coupons;
          return [];
        }
      },
      methods: {
        toggleCouponForm: function toggleCouponForm() {
          this.state.showcouponform = !this.state.showcouponform;
        },
        closeCouponForm: function closeCouponForm() {
          this.state.showcouponform = false;
        },
        applyCoupon: function applyCoupon() {
          var _this = this;
          var couponCode = this.form.coupon;
          if (couponCode && couponCode.length > 3) {
            BX.ajax.runAction('x:api.app.controller.applyCoupon', {
              data: {
                coupon: couponCode
              }
            }).then(function (response) {}, function (response) {
              console.log(response);
            });
            var data = {
              coupon: couponCode,
              sessid: BX.bitrix_sessid()
            };
            BX.ajax.post('/api/basket/coupon/add', data, function (response) {
              response = JSON.parse(response);
              if (response.data) {
                _this.$store.dispatch('update', {
                  key: 'basket',
                  data: response.data
                });
                _this.$nextTick(function () {
                  for (var i in _this.coupons) {
                    if (_this.coupons[i] == couponCode) {
                      x_izi.iziToast.success({
                        timeout: 2000,
                        //title: 'Ошибка', 
                        message: 'The coupon ' + couponCode + ' has been successfully applied'
                      });
                      _this.form.coupon = '';
                      _this.closeCouponForm();
                      return;
                    }
                  }
                  x_izi.iziToast.error({
                    timeout: 6000,
                    title: 'Error',
                    message: 'The coupon ' + couponCode + ' was not applied.<br>Check the code or try again later.'
                  });
                });
              }
            });
          }
        },
        deleteCoupon: function deleteCoupon(couponCode) {
          var _this2 = this;
          if (couponCode && couponCode.length > 3) {
            var data = {
              coupon: couponCode,
              sessid: BX.bitrix_sessid()
            };
            BX.ajax.post('/api/basket/coupon/del', data, function (response) {
              response = JSON.parse(response);
              if (response.data) {
                _this2.$store.dispatch('update', {
                  key: 'basket',
                  data: response.data
                });
              }
            });
          }
        },
        /**
         * подгрузка информации о товарах в корзние
         */
        updateProducts: function updateProducts() {
          var _this$items,
            _this3 = this;
          if ((_this$items = this.items) !== null && _this$items !== void 0 && _this$items.length) {
            var id4update = [];
            for (var i in this.items) {
              var id = this.items[i].productid;
              if (!this.products[id]) {
                id4update.push(id);
              }
            }
            if (id4update.length) {
              if (this.state.waitproducts) {
                return;
              }
              this.state.waitproducts = true;
              var data = {
                id: id4update,
                sessid: BX.bitrix_sessid()
              };
              BX.ajax.post('/catalog/products', data, function (response) {
                response = JSON.parse(response);
                if (response.data) {
                  for (var _id in response.data) {
                    _this3.products[_id] = response.data[_id];
                  }
                }
                _this3.state.waitproducts = false;
              });
            }
          }
        }
      },
      mounted: function mounted() {
        this.updateProducts();
      },
      watch: {
        items: function items(_items) {
          this.updateProducts();
        }
      }
    };

    // Миксин метода удаления товара из козины
    // расчитывает на item в компоненте
    var BasketItemDel = {
      methods: {
        del: function del() {
          var _this4 = this;
          if (this.state) return;
          var item = this.item;
          this.state = 'delete';
          var data = {
            id: this.item.id,
            sessid: BX.bitrix_sessid()
          };
          BX.ajax.post('/api/basket/del', data, function (response) {
            response = JSON.parse(response);
            if (response.data) {
              //BX.onCustomEvent('OnBasketRemoveProduct', {item: item});
              _this4.$store.dispatch('update', {
                key: 'basket',
                data: response.data
              });
            }
            _this4.state = false;
          });
        }
      }
    };

    // item корзины
    var BasketItem = {
      mixins: [BasketItemDel],
      props: {
        item: {},
        product: {}
      },
      data: function data() {
        return {
          state: false
        };
      },
      computed: {
        pricebase: function pricebase() {
          var _this$product, _this$product$PRICE;
          if ((_this$product = this.product) !== null && _this$product !== void 0 && (_this$product$PRICE = _this$product.PRICE) !== null && _this$product$PRICE !== void 0 && _this$product$PRICE.BASE) return this.product.PRICE.BASE;
          return this.item.price;
        },
        pricebaseformated: function pricebaseformated() {
          var _this$product2, _this$product2$PRICE;
          if ((_this$product2 = this.product) !== null && _this$product2 !== void 0 && (_this$product2$PRICE = _this$product2.PRICE) !== null && _this$product2$PRICE !== void 0 && _this$product2$PRICE.BASE_FORMATED) return this.product.PRICE.BASE_FORMATED;
          return currency.Currency.currencyFormat(this.pricebase, 'USD', true);
        },
        sumbase: function sumbase() {
          return this.pricebase * this.item.quantity;
        },
        sumbaseformated: function sumbaseformated() {
          return currency.Currency.currencyFormat(this.sumbase, 'USD', true);
        },
        discount: function discount() {
          if (this.sumbase && this.sumbase > this.item.sum) {
            return this.sumbase - this.item.sum;
          }
          return 0;
        },
        discountpercent: function discountpercent() {
          return Math.ceil(this.discount / this.sumbase * 100);
        },
        available: function available() {
          var _this$product3, _this$product4;
          return ((_this$product3 = this.product) === null || _this$product3 === void 0 ? void 0 : _this$product3.CATALOG_AVAILABLE) == 'Y' && parseInt((_this$product4 = this.product) === null || _this$product4 === void 0 ? void 0 : _this$product4.CATALOG_QUANTITY) > 0;
        }
      },
      methods: {
        requant: function requant(Δ) {
          var _this5 = this;
          if (this.state) return;
          var item = this.item;
          this.state = 'requant';
          var data = {
            id: this.item.id,
            quantity: item.quantity + Δ,
            sessid: BX.bitrix_sessid()
          };
          BX.ajax.post('/api/basket/update', data, function (response) {
            response = JSON.parse(response);
            if (response.data) {
              _this5.$store.dispatch('update', {
                key: 'basket',
                data: response.data
              });
            }
            _this5.state = false;
          });
        }
      }
    };
    var BasketAdd = {
      data: function data() {
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
        basketItem: function basketItem() {
          var _this$$store$state$ba6;
          if ((_this$$store$state$ba6 = this.$store.state.basket) !== null && _this$$store$state$ba6 !== void 0 && _this$$store$state$ba6.items) {
            for (var i in this.$store.state.basket.items) {
              if (this.$store.state.basket.items[i].productid == this.productid) return this.$store.state.basket.items[i];
            }
          }
          return false;
        },
        basketItemCnt: function basketItemCnt() {
          if (this.basketItem) return this.basketItem.quantity;
          return 0;
        }
      },
      methods: {
        changeQnt: function changeQnt(OfferId, Δ /* дельа )), да, так можно */) {
          if (!this.form.offers[OfferId]) this.form.offers[OfferId] = 0;
          this.form.offers[OfferId] = this.form.offers[OfferId] + Δ;
          if (this.form.offers[OfferId] < 1) delete this.form.offers[OfferId];
        },
        add: function add() {
          var _this6 = this;
          if (this.state.exchange) return;
          this.state.exchange = true;
          var items = [];
          for (var id in this.form.offers) {
            items.push({
              id: id,
              quantity: this.form.offers[id]
            });
          }

          //this.form.offers = {}; // сбрасываем

          var data = {
            lstItems: items,
            sessid: BX.bitrix_sessid()
          };
          BX.ajax.post('/api/basket/add', data, function (response) {
            response = JSON.parse(response);
            console.log(response);
            if (response.data) {
              // document.querySelectorAll('[href="/personal/order/make/"]').forEach((n)=>{
              //     n.dataset.count = response.data.count
              // })

              _this6.$store.dispatch('update', {
                key: 'basket',
                data: response.data
              });
            }
            _this6.state.exchange = false;
          });
        }
      }
    };

    exports.Basket = Basket;
    exports.BasketItemDel = BasketItemDel;
    exports.BasketItem = BasketItem;
    exports.BasketAdd = BasketAdd;

}((this.BX.App.Vue.Mixins = this.BX.App.Vue.Mixins || {}),BX,BX.X));
//# sourceMappingURL=s.js.map
