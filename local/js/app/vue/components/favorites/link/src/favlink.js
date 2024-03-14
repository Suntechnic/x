export const FavoriteLink = {
    props: {
		href: {
			type: String,
			required: true
		},
	},
    computed: { s () {return this.$store.state},
        num ()
        {
            return this.$store.state.favorites?.length || 0;
        }
    },
	template: /*vue-html*/`
    <a v-bind:href="href">
        <i class="lnil"><img src="/local/assets/img/izbr.svg" /></i><span v-if="num">{{num}}</span>
    </a>
	`
}
