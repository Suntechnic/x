export const BasketLink = {
	props: {
        href: {}
    },
    computed: {
        basket () {
            return this.$store.state.basket
        },
    },
	template: /* vue-html */`
	<a v-bind:href="href"><i class="lnil"><img src="/local/assets/img/cart.svg"></i><span
            v-if="basket?.count"
        >{{basket.count}}</span></a>
	`
};