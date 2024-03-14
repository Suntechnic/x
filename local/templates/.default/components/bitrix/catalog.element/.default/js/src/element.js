import 'app.vue.components.basket.mixin'; let BasketAdd = BX.App.Vue.Mixins.BasketAdd;

export const CatalogElement = {
    mixins: [BasketAdd],
    inject: ['propses','offers'],
    data () {
		return {
            SelectSizeId: false,
            // OffersCnt: {},
        }
    },
    computed: {
        sizes () {
            let sizes = [];
            if (this.propses.SIZE?.VALUES) {
                for (let i in this.propses.SIZE.VALUES) {
                    if (!this.propses.SIZE.VALUES[i].NA) sizes.push(this.propses.SIZE.VALUES[i]);
                }
            }
            return sizes;
        },
        selectSize () {
            if (this.SelectSizeId)
            {
                for (let id in this.sizes) {
                    if (this.sizes[id].ID == this.SelectSizeId) return this.sizes[id];
                }
            }
            return false;
        },
        selectOffer () {
            if (this.SelectSizeId) {
                for (let i in this.offers) {
                    if (this.offers[i].PROPERTIES_VALUE_ENUM_ID.SIZE == this.SelectSizeId) {
                        return this.offers[i];
                    }
                }
            }
            return false;
        },
        Price () {
            // if (this.Sum) {
            //     return BX.Currency.currencyFormat(this.Sum,'KZT',true);
            // } else {
            //     return this.GoodPrice;
            // }
        },
    },
    created () {
        // this.$nextTick(()=>{

        // });

        if (!this.SelectSizeId && this.sizes.length) {
            this.SelectSizeId = this.sizes[0].ID
        }

        // управление количеством
        // for (let i in this.offers) {
        //     this.OffersCnt[this.offers[i].ID] = 1;
        // }
    },
    watch: {
		selectOffer (Offer)
		{
            let offers = {};
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
        setSize(Code) {
            this.SelectSizeId = Code;
        }
    },
	template: /*vue-html*/`
    <div class="product-size">
        <div class="row align-items-end mb-2">
            <div class="col" v-if="selectSize">
                <strong>Size: </strong> {{selectSize.NAME}}
            </div>
            <!--
            <div class="col-auto">
                <a href="#" class="sizing-guide">Sizing guide</a>
            </div>
            -->
        </div>
        <div class="listing-size">
            <span
                    v-for="val in sizes"
                    v-bind:value="val.ID"
                    v-on:click="setSize(val.ID)"
                    class="size-item" 
                    v-bind:class="{'size-item--active': val.ID==SelectSizeId}"
                >{{val.NAME}}</span>
        </div>
    </div>

    <!--.quantity-->
    
    <div class="product-price" v-if="selectOffer">
        <div class="product-price__value">{{selectOffer.PRINT_RATIO_PRICE}}</div>
        <s 
                class="product-price__value-old"
                v-if="selectOffer.BASE_PRICE > selectOffer.PRICE"
            >{{selectOffer.PRINT_RATIO_BASE_PRICE}}</s>
    </div>

    <div class="row align-items-center ">
        <div class="col mb-4">
            <div class="product-btns">
                <span href="#" class="add-cart second-button" v-on:click="add">Add to cart</span>
            </div>
        </div>
    </div>
    `
}

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