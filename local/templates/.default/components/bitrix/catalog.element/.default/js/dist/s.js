/* eslint-disable */
this.BX = this.BX || {};
this.BX.App = this.BX.App || {};
this.BX.App.Vue = this.BX.App.Vue || {};
(function (exports) {
    'use strict';

    var BasketAdd = BX.App.Vue.Mixins.BasketAdd;
    var CatalogElement = {
      mixins: [BasketAdd],
      inject: ['propses', 'offers'],
      data: function data() {
        return {
          SelectSizeId: false
          // OffersCnt: {},
        };
      },
      computed: {
        sizes: function sizes() {
          var _this$propses$SIZE;
          var sizes = [];
          if ((_this$propses$SIZE = this.propses.SIZE) !== null && _this$propses$SIZE !== void 0 && _this$propses$SIZE.VALUES) {
            for (var i in this.propses.SIZE.VALUES) {
              if (!this.propses.SIZE.VALUES[i].NA) sizes.push(this.propses.SIZE.VALUES[i]);
            }
          }
          return sizes;
        },
        selectSize: function selectSize() {
          if (this.SelectSizeId) {
            for (var id in this.sizes) {
              if (this.sizes[id].ID == this.SelectSizeId) return this.sizes[id];
            }
          }
          return false;
        },
        selectOffer: function selectOffer() {
          if (this.SelectSizeId) {
            for (var i in this.offers) {
              if (this.offers[i].PROPERTIES_VALUE_ENUM_ID.SIZE == this.SelectSizeId) {
                return this.offers[i];
              }
            }
          }
          return false;
        },
        Price: function Price() {
          // if (this.Sum) {
          //     return BX.Currency.currencyFormat(this.Sum,'KZT',true);
          // } else {
          //     return this.GoodPrice;
          // }
        }
      },
      created: function created() {
        // this.$nextTick(()=>{

        // });

        if (!this.SelectSizeId && this.sizes.length) {
          this.SelectSizeId = this.sizes[0].ID;
        }

        // управление количеством
        // for (let i in this.offers) {
        //     this.OffersCnt[this.offers[i].ID] = 1;
        // }
      },
      watch: {
        selectOffer: function selectOffer(Offer) {
          var offers = {};
          if (Offer) {
            offers[Offer.ID] = 1;
          }
          this.form.offers = offers;
        }
      },
      methods: {
        // changeCnt (Δ) 
        // {
        // },
        setSize: function setSize(Code) {
          this.SelectSizeId = Code;
        }
      },
      template: /*vue-html*/"\n    <div class=\"product-size\">\n        <div class=\"row align-items-end mb-2\">\n            <div class=\"col\" v-if=\"selectSize\">\n                <strong>Size: </strong> {{selectSize.NAME}}\n            </div>\n            <!--\n            <div class=\"col-auto\">\n                <a href=\"#\" class=\"sizing-guide\">Sizing guide</a>\n            </div>\n            -->\n        </div>\n        <div class=\"listing-size\">\n            <span\n                    v-for=\"val in sizes\"\n                    v-bind:value=\"val.ID\"\n                    v-on:click=\"setSize(val.ID)\"\n                    class=\"size-item\" \n                    v-bind:class=\"{'size-item--active': val.ID==SelectSizeId}\"\n                >{{val.NAME}}</span>\n        </div>\n    </div>\n\n    <!--.quantity-->\n    \n    <div class=\"product-price\" v-if=\"selectOffer\">\n        <div class=\"product-price__value\">{{selectOffer.PRINT_RATIO_PRICE}}</div>\n        <s \n                class=\"product-price__value-old\"\n                v-if=\"selectOffer.BASE_PRICE > selectOffer.PRICE\"\n            >{{selectOffer.PRINT_RATIO_BASE_PRICE}}</s>\n    </div>\n\n    <div class=\"row align-items-center \">\n        <div class=\"col mb-4\">\n            <div class=\"product-btns\">\n                <span href=\"#\" class=\"add-cart second-button\" v-on:click=\"add\">Add to cart</span>\n            </div>\n        </div>\n    </div>\n    "
    };

    /**
     * 
     <div class="quantity">
        <div class="quantity-title">
            Quantity
        </div>
        <div class="quantity-item">
            <button class="quantity-btn minus"></button>
            <input type="text" value="1">
            <button class="quantity-btn plus"></button>
        </div>
    </div>
     */

    exports.CatalogElement = CatalogElement;

}((this.BX.App.Vue.Components = this.BX.App.Vue.Components || {})));
//# sourceMappingURL=s.js.map
