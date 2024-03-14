export const FavoriteButton = {
	props: {
		elementid: {
			//type: Number,
			required: true
		},
        template: {
			type: String
		},
	},
    computed: { //s () {return this.$store.state},
        isActive ()
        {
            return typeof this.$_getIndex() != 'undefined';
        }
    },
    methods: {
        $_getIndex () {
            if (this.$store?.state.favorites?.length) {
                for (let i in this.$store.state.favorites) {
                    let elementid = this.$store.state.favorites[i];
                    if (this.elementid == elementid) {
                        return i;
                    }
                }
            }
        },
        toggle ()
        {

            let point = '/api/favorites/add';
            if (this.isActive) point = '/api/favorites/del';

            let data = {
                    Id: this.elementid,
                    sessid: BX.bitrix_sessid()
                };
                
            BX.ajax.post(
                    point,
                    data,
                    (response) => {
                        response = JSON.parse(response);
                        console.log(response);
                        if (response.status == 'error') {
                            console.log('app.vue.components.favorites.button',response);
                        } else if (response.status == 'success') {
                            if (response.status == 'success' && response.data) {
                                this.$store.commit('update',{'key':'favorites', 'data':response.data});
                            }
                        }
                    }
                );
        }
    },
	template: /*vue-html*/`
    <span v-if="template == 'circle'" class="add-favorite" v-on:click.prevent="toggle">
        <svg width="24" height="22" viewBox="0 0 24 22"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M16.6375 1C20.55 1 23.1625 4.725 23.1625 8.2C23.1625 15.2375 12.275 21 12.0875 21C11.9 21 1 15.2375 1 8.2C1 4.725 3.625 1 7.525 1C9.7625 1 11.225 2.1375 12.075 3.1375C12.925 2.125 14.3875 1 16.625 1H16.6375Z"
                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </span>

    <i v-else 
            class="lnil" 
            v-bind:class="{'lnil-heart':!isActive, 'lnil-heart-filled':isActive}"
            v-on:click.prevent="toggle"
        ></i>
	`
}
