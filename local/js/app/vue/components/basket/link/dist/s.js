/* eslint-disable */
this.BX = this.BX || {};
this.BX.App = this.BX.App || {};
this.BX.App.Vue = this.BX.App.Vue || {};
(function (exports) {
    'use strict';

    var BasketLink = {
      props: {
        href: {}
      },
      computed: {
        basket: function basket() {
          return this.$store.state.basket;
        }
      },
      template: /* vue-html */"\n\t<a v-bind:href=\"href\"><i class=\"lnil\"><img src=\"/local/assets/img/cart.svg\"></i><span\n            v-if=\"basket?.count\"\n        >{{basket.count}}</span></a>\n\t"
    };

    exports.BasketLink = BasketLink;

}((this.BX.App.Vue.Components = this.BX.App.Vue.Components || {})));
//# sourceMappingURL=s.js.map
