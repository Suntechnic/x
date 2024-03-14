/* eslint-disable */
this.BX = this.BX || {};
this.BX.App = this.BX.App || {};
this.BX.App.Vue = this.BX.App.Vue || {};
(function (exports,app_vue_components_basket_mixin) {
    'use strict';

    var BasketMinimal = {
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
      template: /* vue-html */"\n    <div class=\"mobile-checkout\">\n        <div class=\"row\">\n            <div class=\"col-auto\">\n                <div v-if=\"basket?.count\" class=\"mobile-checkout__count\">\n                    {{basket.count}}\n                </div>\n            </div>\n            <div class=\"col\">\n                <div class=\"mobile-checkout__details\">\n                    <div class=\"row mb-3\">\n                        <div class=\"col\">\n                            <div class=\"mobile-checkout__info\">\n                                <div>Subtotal: <strong v-html=\"sumbaseFormated\"></strong></div>\n                                <div v-for=\"con in conex\">{{con.title}}: <span v-html=\"con.priceformated\"></span></div>\n                                <div v-if=\"total?.ORDER_TOTAL_PRICE_FORMATED\">Total: <strong><span v-html=\"total.ORDER_TOTAL_PRICE_FORMATED\"></span></strong></div>\n                            </div>\n                        </div>\n                        <!--<div class=\"col-auto\">\n                            <a href=\"#\">Edit</a>\n                        </div>-->\n                    </div>\n                    <div class=\"position-relative footer__newsleter\">\n                        <div class=\"promocode\" v-for=\"coupon in coupons\">\n                            Used coupon: {{coupon}} <button v-on:click.stop.prevent=\"deleteCoupon(coupon)\">Delete</button>\n                        </div>\n                        <input type=\"email\" class=\"footer__newsleter-input\"\n                            placeholder=\"Discount code or gift card\"  v-model=\"form.coupon\">\n                        <button v-on:click.stop.prevent=\"applyCoupon\"><svg width=\"18\" height=\"14\" viewBox=\"0 0 18 14\" fill=\"none\"\n                                xmlns=\"http://www.w3.org/2000/svg\">\n                                <path d=\"M1.47998 6.97998H16.47\" stroke-width=\"1.5\"\n                                    stroke-linecap=\"round\" stroke-linejoin=\"round\"></path>\n                                <path d=\"M10.48 0.98999L16.52 6.99999L10.48 13.01\"\n                                    stroke-width=\"1.5\" stroke-linecap=\"round\"\n                                    stroke-linejoin=\"round\"></path>\n                            </svg></button>\n                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n\t"
    };

    exports.BasketMinimal = BasketMinimal;

}((this.BX.App.Vue.Components = this.BX.App.Vue.Components || {}),BX.App.Vue.Mixins));
//# sourceMappingURL=s.js.map
