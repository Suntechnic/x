/* eslint-disable */
this.BX = this.BX || {};
this.BX.App = this.BX.App || {};
this.BX.App.Vue = this.BX.App.Vue || {};
(function (exports) {
    'use strict';

    var FavoriteLink = {
      props: {
        href: {
          type: String,
          required: true
        }
      },
      computed: {
        s: function s() {
          return this.$store.state;
        },
        num: function num() {
          var _this$$store$state$fa;
          return ((_this$$store$state$fa = this.$store.state.favorites) === null || _this$$store$state$fa === void 0 ? void 0 : _this$$store$state$fa.length) || 0;
        }
      },
      template: /*vue-html*/"\n    <a v-bind:href=\"href\">\n        <i class=\"lnil\"><img src=\"/local/assets/img/izbr.svg\" /></i><span v-if=\"num\">{{num}}</span>\n    </a>\n\t"
    };

    exports.FavoriteLink = FavoriteLink;

}((this.BX.App.Vue.Components = this.BX.App.Vue.Components || {})));
//# sourceMappingURL=s.js.map
