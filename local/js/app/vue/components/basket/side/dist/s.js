/* eslint-disable */
this.BX = this.BX || {};
this.BX.App = this.BX.App || {};
this.BX.App.Vue = this.BX.App.Vue || {};
(function (exports,app_vue_components_basket_mixin,x_util) {
    'use strict';

    var BasketSideItem = {
      mixins: [app_vue_components_basket_mixin.BasketItem, app_vue_components_basket_mixin.BasketItemDel],
      template: /* vue-html */"\n    <div class=\"product-basket\">\n        <div class=\"product-basket__preview\" v-if=\"product\">\n            <img v-if=\"product.PICTURE\" v-bind:src=\"product.PICTURE.SRC\" alt=\"\" loading=\"lazy\">\n        </div>\n        <div class=\"product-basket__main\">\n            <div class=\"product-basket__name\">\n                {{item.name}}\n            </div>\n            <div class=\"product-basket__size\" v-for=\"prop in item.properties\">\n                {{prop.NAME}}: {{prop.VALUE}}\n            </div>\n            <div class=\"row align-items-center\">\n                <div class=\"col\">\n                    <div class=\"cart-product__quantity-field\">\n                        <div class=\"quantity-field__minus\" v-on:click=\"requant(-1)\"></div>\n                        <input type=\"text\" v-model=\"item.quantity\" class=\"quantity-field__input\" disable>\n                        <div class=\"quantity-field__plus\" v-on:click=\"requant(1)\"></div>\n                    </div>\n                </div>\n                <div class=\"col-auto\">\n                    <div class=\"product-basket__price\" v-html=\"item.sumformated\"></div>\n                </div>\n            </div>\n        </div>\n    </div>\n\t"
    };
    var BasketSide = {
      components: {
        Item: BasketSideItem
      },
      mixins: [app_vue_components_basket_mixin.Basket],
      props: {
        conex: {
          type: Object,
          "default": []
        },
        total: {
          type: String
        }
      },
      computed: {
        itemsNumTitle: function itemsNumTitle() {
          var _this$$store$state$ba, _this$$store$state$ba2;
          if ((_this$$store$state$ba = this.$store.state.basket) !== null && _this$$store$state$ba !== void 0 && (_this$$store$state$ba2 = _this$$store$state$ba.items) !== null && _this$$store$state$ba2 !== void 0 && _this$$store$state$ba2.length) {
            return x_util.Grammar.declOfNum(this.$store.state.basket.items.length, ['товар',
            // 1 товар
            'товара',
            // 2 товара
            'товаров' // 10 товаров
            ]);
          } else {
            return '';
          }
        }
      },
      watch: {
        hash: {
          // сообщаем родителю, что корзина изменилась
          handler: function handler(val, oval) {
            if (val && val != oval) {
              this.$emit('basketchange', val);
            }
          }
        }
      },
      template: /* vue-html */"\n    <div class=\"baskets-main\">\n        <div class=\"list-baskets\">\n            <Item v-for=\"item in items\" v-bind:key=\"item.id\" v-bind:item=\"item\" v-bind:product=\"products[item.productid]\"></Item>\n        </div>\n        \n        <form class=\"discount-form\">\n            <div class=\"promocode\" v-for=\"coupon in coupons\">\n                Used coupon: {{coupon}} <button v-on:click.stop.prevent=\"deleteCoupon(coupon)\">Delete</button>\n            </div>\n            <input type=\"text\" placeholder=\"Discount code or gift card\" v-model=\"form.coupon\">\n            <button v-on:click.stop.prevent=\"applyCoupon\"></button>\n        </form>\n        <div class=\"baskets-info\">\n            <div class=\"row mb-2\">\n                <div class=\"col\">Subtotal</div>\n                <div class=\"col-auto\" v-html=\"sumbaseFormated\"></div>\n            </div>\n            <div class=\"row mb-1\" v-for=\"con in conex\">\n                <div class=\"col\">\n                    {{con.title}}\n                </div>\n                <div class=\"col-auto\">\n                    <strong v-html=\"con.priceformated\"></strong>\n                </div>\n            </div>\n            <div class=\"row total-price-basket\" v-if=\"total?.ORDER_TOTAL_PRICE_FORMATED\">\n                <div class=\"col\">Total</div>\n                <div class=\"col-auto\"><strong v-html=\"total.ORDER_TOTAL_PRICE_FORMATED\"></strong></div>\n            </div>\n        </div>\n\n    </div>\n\t"
    };

    exports.BasketSideItem = BasketSideItem;
    exports.BasketSide = BasketSide;

}((this.BX.App.Vue.Components = this.BX.App.Vue.Components || {}),BX.App.Vue.Mixins,BX.X.Util));
//# sourceMappingURL=s.js.map
