import {iziToast} from 'x.izi';

export const FormAccount = {
	props: {
		userid: {
			//type: Number,
			required: true
		}
	},
	data ()
	{
		return {
			values: {
				
			},
            valuesnew: {

            },
            pass: {
                pass: '',
                confirm: ''
            },
            state: {
                edditing: {
                    name: false,
                    email: false,
                    pass: false
                }
            }
		}
	},
	computed: {
        isNotSaved ()
        {
            for (let i in this.values) {
                if (this.values[i] != this.valuesnew[i]) return true;
            }
            if (this.pass.pass && this.pass.pass == this.pass.confirm) return true;
            return false;
        }
    },
	methods: {
		save ()
		{
            let data = {
                    Id: this.userid,
                    sessid: BX.bitrix_sessid()
                };
            
            // знаения полей
            let Values = {};
            for (let i in this.values) {
                if (this.values[i] != this.valuesnew[i]) Values[i] = this.valuesnew[i];
            }
            if (Object.keys(Values).length) {
                data.Values = Values;
            }
            // пароль
            if (this.pass.pass && this.pass.pass == this.pass.confirm) {
                data.Pass = this.pass;
            }

			if (data.Values || data.Pass) {
                let vm = this;

				BX.ajax.post(
                        '/api/user/update',
                        data,
                        (response) => {
                            response = JSON.parse(response);
                            //console.log(response);
                            if (response.status == 'error') {
                                for (let i in response.errors) {
                                    let error = response.errors[i];
                                    if (error.code == 'invalid_csrf') {
                                       iziToast.error({
                                                timeout: 0,
                                                title: 'Error',
                                                message: 'Your session has expired. Refresh the page and try again.',
                                            });
                                    } else console.error('Error', error.message);
                                }
                            } else if (response.status == 'success') {
                                if (response.data.userid == vm.userid && response.data.values) {
                                    vm.updateValues(response.data.values);
                                    iziToast.success({
                                            timeout: 0,
                                            title: 'Saved'
                                        });
                                } else {
                                    iziToast.error({
                                            timeout: 0,
                                            title: 'Error',
                                            message: 'The something went wrong - please try again later',
                                        });
                                }
                                
                            }
                        }
                    );
            } else {
                iziToast.error({
                        timeout: 0,
                        title: 'Error',
                        message: '',
                    });
			}
		},
		fetchData ()
		{
            let data = {
                    Id: this.userid,
                    sessid: BX.bitrix_sessid()
                };

			let vm = this;
            BX.ajax.post(
                '/api/user',
                data,
                (response) => {
                    response = JSON.parse(response);
                    //console.log(response);
                    if (response.status == 'error') {
                        for (let i in response.errors) {
                            let error = response.errors[i];
                            if (error.code == 'invalid_csrf') {
                                iziToast.error({
                                        timeout: 0,
                                        title: 'Error',
                                        message: 'Your session has expired. Refresh the page and try again.',
                                    });
                            } else console.error('Error', error.message);
                        }
                    } else if (response.status == 'success') {
                        if (response.data.userid == vm.userid && response.data.values) {
                            vm.updateValues(response.data.values);
                        } else {
                            iziToast.error({
                                    timeout: 0,
                                    title: 'Error',
                                    message: 'The something went wrong - please try again later',
                                });
                        }
                        
                    }
                }
            );


			// BX.ajax.runAction('sdvv:askona.api.user.getUserProfile', {data:{id:vm.userid}})
            //     .then((response) => {
			// 		if (response.data.values) vm.updateValues(response.data.values);
            //     }, (response) => {
            //         console.log(response);
            //     });
		},
		updateValues (values)
		{
			for (let k in values) {
				this.values[k] = values[k];
			}
            for (let k in values) {
				this.valuesnew[k] = values[k];
			}
		},

        edit (block)
		{
			this.state.edditing[block] = true;
		},

        apply (block)
		{
            if (block == 'pass' && this.pass.pass != this.pass.confirm) {
                iziToast.error({
                        timeout: 0,
                        title: 'Error',
                        message: 'Password and confirmation do not match',
                    });
                return;
            }
			this.state.edditing[block] = false;
		}
	},
	created()
	{
		// получение данных
		this.fetchData();
	},
	template: /* vue-html */`
    <form action="" class="edit-profile">
        <div class="edit-profile-item">
            <div class="edit-profile-item__label">
                Your Name
            </div>
            <div class="edit-profile-item__input">
                <input type="text" 
                        v-model="valuesnew.NAME" 
                        v-bind:disabled="!state.edditing.name" 
                        v-bind:style="valuesnew.NAME!=values.NAME?'color:#928656;':''"
                    >
                <input type="text" 
                        v-model="valuesnew.LAST_NAME" 
                        v-bind:disabled="!state.edditing.name"
                        v-bind:style="valuesnew.LAST_NAME!=values.LAST_NAME?'color:#928656;':''"
                    >
            </div>
            <div v-if="state.edditing.name" class="edit-profile-item__edit" v-on:click="apply('name')">Apply</div>
            <div v-else class="edit-profile-item__edit" v-on:click="edit('name')">Edit</div>
        </div>
        <div class="edit-profile-item">
            <div class="edit-profile-item__label">
                Your Email
            </div>
            <div class="edit-profile-item__input">
                <input type="email" v-model="valuesnew.EMAIL" v-bind:disabled="!state.edditing.email">
            </div>
            <div v-if="state.edditing.email" class="edit-profile-item__edit" v-on:click="apply('email')">Apply</div>
            <div v-else class="edit-profile-item__edit" v-on:click="edit('email')">Edit</div>
        </div>
        <div class="edit-profile-item">
            <div class="edit-profile-item__label">
                Your Password
            </div>
            <div class="edit-profile-item__input">
                
                <input v-if="state.edditing.pass" type="password" v-model="pass.pass">
                <input v-if="state.edditing.pass" type="password" v-model="pass.confirm">
                <input v-else type="password" value="12345678" v-bind:style="pass.pass?'color:#928656;':''" disabled>
            </div>
            <div v-if="state.edditing.pass" class="edit-profile-item__edit" v-on:click="apply('pass')">Apply</div>
            <div v-else class="edit-profile-item__edit" v-on:click="edit('pass')">Edit</div>
        </div>
        <button v-if="isNotSaved" v-on:click.stop.prevent="save" class="second-button save-lk-button">Save</button>
    </form>
	`
}
