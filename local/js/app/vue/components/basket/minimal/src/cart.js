import {Basket} from 'app.vue.components.basket.mixin';

export const BasketMinimal = {
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
    <div class="mobile-checkout">
        <div class="row">
            <div class="col-auto">
                <div v-if="basket?.count" class="mobile-checkout__count">
                    {{basket.count}}
                </div>
            </div>
            <div class="col">
                <div class="mobile-checkout__details">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="mobile-checkout__info">
                                <div>Subtotal: <strong v-html="sumbaseFormated"></strong></div>
                                <div v-for="con in conex">{{con.title}}: <span v-html="con.priceformated"></span></div>
                                <div v-if="total?.ORDER_TOTAL_PRICE_FORMATED">Total: <strong><span v-html="total.ORDER_TOTAL_PRICE_FORMATED"></span></strong></div>
                            </div>
                        </div>
                        <!--<div class="col-auto">
                            <a href="#">Edit</a>
                        </div>-->
                    </div>
                    <div class="position-relative footer__newsleter">
                        <div class="promocode" v-for="coupon in coupons">
                            Used coupon: {{coupon}} <button v-on:click.stop.prevent="deleteCoupon(coupon)">Delete</button>
                        </div>
                        <input type="email" class="footer__newsleter-input"
                            placeholder="Discount code or gift card"  v-model="form.coupon">
                        <button v-on:click.stop.prevent="applyCoupon"><svg width="18" height="14" viewBox="0 0 18 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.47998 6.97998H16.47" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M10.48 0.98999L16.52 6.99999L10.48 13.01"
                                    stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
	`
};