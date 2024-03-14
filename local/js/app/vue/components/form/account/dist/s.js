/* eslint-disable */
this.BX = this.BX || {};
this.BX.App = this.BX.App || {};
this.BX.App.Vue = this.BX.App.Vue || {};
(function (exports,x_izi) {
    'use strict';

    var FormAccount = {
      props: {
        userid: {
          //type: Number,
          required: true
        }
      },
      data: function data() {
        return {
          values: {},
          valuesnew: {},
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
        };
      },
      computed: {
        isNotSaved: function isNotSaved() {
          for (var i in this.values) {
            if (this.values[i] != this.valuesnew[i]) return true;
          }
          if (this.pass.pass && this.pass.pass == this.pass.confirm) return true;
          return false;
        }
      },
      methods: {
        save: function save() {
          var data = {
            Id: this.userid,
            sessid: BX.bitrix_sessid()
          };

          // знаения полей
          var Values = {};
          for (var i in this.values) {
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
            var vm = this;
            BX.ajax.post('/api/user/update', data, function (response) {
              response = JSON.parse(response);
              //console.log(response);
              if (response.status == 'error') {
                for (var _i in response.errors) {
                  var error = response.errors[_i];
                  if (error.code == 'invalid_csrf') {
                    x_izi.iziToast.error({
                      timeout: 0,
                      title: 'Error',
                      message: 'Your session has expired. Refresh the page and try again.'
                    });
                  } else console.error('Error', error.message);
                }
              } else if (response.status == 'success') {
                if (response.data.userid == vm.userid && response.data.values) {
                  vm.updateValues(response.data.values);
                  x_izi.iziToast.success({
                    timeout: 0,
                    title: 'Saved'
                  });
                } else {
                  x_izi.iziToast.error({
                    timeout: 0,
                    title: 'Error',
                    message: 'The something went wrong - please try again later'
                  });
                }
              }
            });
          } else {
            x_izi.iziToast.error({
              timeout: 0,
              title: 'Error',
              message: ''
            });
          }
        },
        fetchData: function fetchData() {
          var data = {
            Id: this.userid,
            sessid: BX.bitrix_sessid()
          };
          var vm = this;
          BX.ajax.post('/api/user', data, function (response) {
            response = JSON.parse(response);
            //console.log(response);
            if (response.status == 'error') {
              for (var i in response.errors) {
                var error = response.errors[i];
                if (error.code == 'invalid_csrf') {
                  x_izi.iziToast.error({
                    timeout: 0,
                    title: 'Error',
                    message: 'Your session has expired. Refresh the page and try again.'
                  });
                } else console.error('Error', error.message);
              }
            } else if (response.status == 'success') {
              if (response.data.userid == vm.userid && response.data.values) {
                vm.updateValues(response.data.values);
              } else {
                x_izi.iziToast.error({
                  timeout: 0,
                  title: 'Error',
                  message: 'The something went wrong - please try again later'
                });
              }
            }
          });

          // BX.ajax.runAction('sdvv:askona.api.user.getUserProfile', {data:{id:vm.userid}})
          //     .then((response) => {
          // 		if (response.data.values) vm.updateValues(response.data.values);
          //     }, (response) => {
          //         console.log(response);
          //     });
        },
        updateValues: function updateValues(values) {
          for (var k in values) {
            this.values[k] = values[k];
          }
          for (var _k in values) {
            this.valuesnew[_k] = values[_k];
          }
        },
        edit: function edit(block) {
          this.state.edditing[block] = true;
        },
        apply: function apply(block) {
          if (block == 'pass' && this.pass.pass != this.pass.confirm) {
            x_izi.iziToast.error({
              timeout: 0,
              title: 'Error',
              message: 'Password and confirmation do not match'
            });
            return;
          }
          this.state.edditing[block] = false;
        }
      },
      created: function created() {
        // получение данных
        this.fetchData();
      },
      template: /* vue-html */"\n    <form action=\"\" class=\"edit-profile\">\n        <div class=\"edit-profile-item\">\n            <div class=\"edit-profile-item__label\">\n                Your Name\n            </div>\n            <div class=\"edit-profile-item__input\">\n                <input type=\"text\" \n                        v-model=\"valuesnew.NAME\" \n                        v-bind:disabled=\"!state.edditing.name\" \n                        v-bind:style=\"valuesnew.NAME!=values.NAME?'color:#928656;':''\"\n                    >\n                <input type=\"text\" \n                        v-model=\"valuesnew.LAST_NAME\" \n                        v-bind:disabled=\"!state.edditing.name\"\n                        v-bind:style=\"valuesnew.LAST_NAME!=values.LAST_NAME?'color:#928656;':''\"\n                    >\n            </div>\n            <div v-if=\"state.edditing.name\" class=\"edit-profile-item__edit\" v-on:click=\"apply('name')\">Apply</div>\n            <div v-else class=\"edit-profile-item__edit\" v-on:click=\"edit('name')\">Edit</div>\n        </div>\n        <div class=\"edit-profile-item\">\n            <div class=\"edit-profile-item__label\">\n                Your Email\n            </div>\n            <div class=\"edit-profile-item__input\">\n                <input type=\"email\" v-model=\"valuesnew.EMAIL\" v-bind:disabled=\"!state.edditing.email\">\n            </div>\n            <div v-if=\"state.edditing.email\" class=\"edit-profile-item__edit\" v-on:click=\"apply('email')\">Apply</div>\n            <div v-else class=\"edit-profile-item__edit\" v-on:click=\"edit('email')\">Edit</div>\n        </div>\n        <div class=\"edit-profile-item\">\n            <div class=\"edit-profile-item__label\">\n                Your Password\n            </div>\n            <div class=\"edit-profile-item__input\">\n                \n                <input v-if=\"state.edditing.pass\" type=\"password\" v-model=\"pass.pass\">\n                <input v-if=\"state.edditing.pass\" type=\"password\" v-model=\"pass.confirm\">\n                <input v-else type=\"password\" value=\"12345678\" v-bind:style=\"pass.pass?'color:#928656;':''\" disabled>\n            </div>\n            <div v-if=\"state.edditing.pass\" class=\"edit-profile-item__edit\" v-on:click=\"apply('pass')\">Apply</div>\n            <div v-else class=\"edit-profile-item__edit\" v-on:click=\"edit('pass')\">Edit</div>\n        </div>\n        <button v-if=\"isNotSaved\" v-on:click.stop.prevent=\"save\" class=\"second-button save-lk-button\">Save</button>\n    </form>\n\t"
    };

    exports.FormAccount = FormAccount;

}((this.BX.App.Vue.Components = this.BX.App.Vue.Components || {}),BX.X));
//# sourceMappingURL=s.js.map
