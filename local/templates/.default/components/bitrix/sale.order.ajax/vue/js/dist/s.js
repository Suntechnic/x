/* eslint-disable */
this.BX = this.BX || {};
this.BX.App = this.BX.App || {};
this.BX.App.Vue = this.BX.App.Vue || {};
(function (exports,x_vue_components_ui,x_izi,currency) {
    'use strict';

    var PhoneInput = BX.X.Vue.Components.PhoneInput;
    var Selector = BX.X.Vue.Components.Selector;
    var iziToast = BX.X.iziToast;
    var BasketMinimal = BX.App.Vue.Components.BasketMinimal;
    var BasketSide = BX.App.Vue.Components.BasketSide;
    console.log(BasketSide);
    var Order = {
      components: {
        BasketMinimal: BasketMinimal,
        BasketSide: BasketSide,
        PhoneInput: PhoneInput,
        Selector: Selector
      },
      inject: ['initdata', 'dictionaries'],
      data: function data() {
        return {
          // bx параметры
          hashBasket: '',
          arResult: {},
          // счётчик обмена
          exchange: 0,
          // форма 
          form: {
            ORDER_DESCRIPTION: '',
            DELIVERY: '',
            BUYER_STORE: '',
            PAYSYSTEM: '',
            properties: {}
          },
          errors: {
            ORDER_DESCRIPTION: '',
            DELIVERY: '',
            PAYSYSTEM: '',
            properties: {}
          },
          state: {
            step: 2,
            lang: false
          },
          reflection: {
            updateData: 0
          },
          dictionary: {},
          agreement: false,
          // карта свойств
          // объект condition содержит два ключа - key и val
          // если в пользовательском свойстве значение ключа с именем key равно val
          // то данное свойство будет замаплено:
          // - в form оно будет иметь имя fieldname
          // - кроме того оно не будет выводится итератором свойств
          // это необходимо для того, чтобы придать определенным свойствам нужно положение и вид в форме
          // и связать их с данными по независимому от настроек битрикс ключу
          map: [{
            condition: {
              key: 'IS_LOCATION',
              val: 'Y'
            },
            fieldname: 'LOCATION'
          }, {
            condition: {
              key: 'IS_PHONE',
              val: 'Y'
            },
            fieldname: 'PHONE'
          }, {
            condition: {
              key: 'IS_EMAIL',
              val: 'Y'
            },
            fieldname: 'EMAIL'
          }, {
            condition: {
              key: 'CODE',
              val: 'NAME'
            },
            fieldname: 'NAME'
          }, {
            condition: {
              key: 'IS_PAYER',
              val: 'Y'
            },
            fieldname: 'LASTNAME'
          }, {
            condition: {
              key: 'IS_ZIP',
              val: 'Y'
            },
            fieldname: 'ZIP'
          }, {
            condition: {
              key: 'CODE',
              val: 'CITY'
            },
            fieldname: 'CITY'
          }, {
            condition: {
              key: 'IS_ADDRESS',
              val: 'Y'
            },
            fieldname: 'ADDRESS'
          }, {
            condition: {
              key: 'CODE',
              val: 'DESCRIPTION'
            },
            fieldname: 'DESCRIPTION'
          }]
        };
      },
      computed: {
        basketEmpty: function basketEmpty() {
          var _this$$store$state$ba, _this$$store$state$ba2;
          return false;
          return !((_this$$store$state$ba = this.$store.state.basket) !== null && _this$$store$state$ba !== void 0 && (_this$$store$state$ba2 = _this$$store$state$ba.items) !== null && _this$$store$state$ba2 !== void 0 && _this$$store$state$ba2.length);
        },
        // реорганизация
        properties: function properties() {
          var _this$arResult, _this$arResult$ORDER_;
          // список свойств - изменяется при апдейте arResult, в т.ч. 
          // в процесс периодических изменений
          var properties = [];
          if ((_this$arResult = this.arResult) !== null && _this$arResult !== void 0 && (_this$arResult$ORDER_ = _this$arResult.ORDER_PROP) !== null && _this$arResult$ORDER_ !== void 0 && _this$arResult$ORDER_.properties) {
            properties = JSON.parse(JSON.stringify(this.arResult.ORDER_PROP.properties));
            for (var i in properties) {
              var property = properties[i];
              property.SENDNAME = 'ORDER_PROP_' + property.ID;
              property.MAPED = false;
              for (var _i in this.map) {
                var maping = this.map[_i];
                if (property[maping.condition.key] == maping.condition.val) {
                  property.FIELDNAME = maping.fieldname;
                  property.MAPED = true;
                  break;
                }
              }
              if (!property.MAPED) property.FIELDNAME = property.SENDNAME;
            }
          }
          return properties;
        },
        propertiesUnmaped: function propertiesUnmaped() {
          var propertiesUnmaped = [];
          for (var i in this.properties) {
            var property = this.properties[i];
            if (!property.MAPED) propertiesUnmaped.push(property);
          }
          return propertiesUnmaped;
        },
        locations: function locations() {
          var _this$arResult2;
          // список местоположений

          var locations = [];
          if ((_this$arResult2 = this.arResult) !== null && _this$arResult2 !== void 0 && _this$arResult2.LOCATION) {
            //locations = JSON.parse(JSON.stringify(this.arResult.LOCATION));
            Object.entries(this.arResult.LOCATION).forEach(function (_ref) {
              var _ref2 = babelHelpers.slicedToArray(_ref, 2),
                key = _ref2[0],
                value = _ref2[1];
              locations.push({
                code: value,
                title: key
              });
            });
          }
          return locations;
        },
        paysystems: function paysystems() {
          var _this$arResult3;
          // список платежных систем

          var paysystems = {};
          if ((_this$arResult3 = this.arResult) !== null && _this$arResult3 !== void 0 && _this$arResult3.PAY_SYSTEM) {
            paysystems = JSON.parse(JSON.stringify(this.arResult.PAY_SYSTEM));
          }
          return paysystems;
        },
        paysystem: function paysystem() {
          // выбранная система
          for (var i in this.paysystems) {
            if (this.paysystems[i].CHECKED == 'Y') {
              return this.paysystems[i];
            }
          }
        },
        deliveries: function deliveries() {
          var _this$arResult4;
          // список доставок

          var deliveries = {};
          if ((_this$arResult4 = this.arResult) !== null && _this$arResult4 !== void 0 && _this$arResult4.DELIVERY) {
            deliveries = JSON.parse(JSON.stringify(this.arResult.DELIVERY));
            // преобразования
            for (var id in deliveries) {
              deliveries[id].PRICE_FORMATED = currency.Currency.currencyFormat(deliveries[id].PRICE, deliveries[id].CURRENCY, true);
            }
          }
          return deliveries;
        },
        delivery: function delivery() {
          // выбранная доставка берется из доставки отмеченной Y, которая обновляется при обновлении this.arResult
          for (var id in this.deliveries) {
            if (this.deliveries[id].CHECKED == 'Y') {
              return this.deliveries[id];
            }
          }
        },
        deliveryStores: function deliveryStores() {
          var _this$delivery, _this$delivery$STORE;
          // выбранная доставка
          var stores = false;
          if ((_this$delivery = this.delivery) !== null && _this$delivery !== void 0 && (_this$delivery$STORE = _this$delivery.STORE) !== null && _this$delivery$STORE !== void 0 && _this$delivery$STORE.length) {
            stores = [];
            for (var i in this.delivery.STORE) {
              var StoreId = this.delivery.STORE[i];
              stores.push(JSON.parse(JSON.stringify(this.arResult.STORE_LIST[StoreId])));
            }
          }
          return stores;
        },
        store: function store() {
          if (this.form.BUYER_STORE) {
            return this.arResult.STORE_LIST[this.form.BUYER_STORE];
          }
          return false;
        },
        displayedDeliveryAddress: function displayedDeliveryAddress() {
          if (this.store) {
            return this.store.ADDRESS;
          } else {
            var addressTokens = [];
            for (var i in this.propertiesUserPropsDelivery) {
              var val = this.form.properties[this.propertiesUserPropsDelivery[i].FIELDNAME];
              if (val) addressTokens.push(val);
            }
            return addressTokens.join(', ');
          }
        },
        total: function total() {
          var _this$arResult5;
          var total = {};
          if ((_this$arResult5 = this.arResult) !== null && _this$arResult5 !== void 0 && _this$arResult5.TOTAL) {
            total = JSON.parse(JSON.stringify(this.arResult.TOTAL));
          } else {
            total = {
              BASKET_POSITIONS: 0,
              ORDER_TOTAL_PRICE: 0
            };
          }
          // преобразования
          if (typeof total.ORDER_TOTAL_PRICE != 'undefined') {
            total.ORDER_TOTAL_PRICE_FORMATED = currency.Currency.currencyFormat(total.ORDER_TOTAL_PRICE, 'USD', true);
          } else {
            total.ORDER_TOTAL_PRICE_FORMATED = '';
          }
          return total;
        },
        // сопутствующие расходы
        conex: function conex() {
          var conex = [];
          conex.push({
            'title': 'Shipping',
            'price': this.total.DELIVERY_PRICE,
            'priceformated': currency.Currency.currencyFormat(this.total.DELIVERY_PRICE, 'USD', true) // this.total.DELIVERY_PRICE_FORMATED,
          });
          return conex;
        }
      },
      watch: {
        exchange: {
          handler: function handler(val, oval) {
          }
        },
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // вотчеры изменяющие errors
        form: {
          // следим за форм, и если текущее значение свойства, отличается от ошиюбочного - гасим ошибку
          handler: function handler(form) {
            if (this.properties) {
              for (var i in this.properties) {
                var property = this.properties[i];
                if (typeof this.errors.properties[property.FIELDNAME] != 'undefined') {
                  // в этом свойстве есть ошибка
                  if (this.errors.properties[property.FIELDNAME].value != this.form.properties[property.FIELDNAME]) delete this.errors.properties[property.FIELDNAME]; // гасим ее
                }
              }
            }
          },
          deep: true
        },
        // вотчеры изменяющие errors
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // вотчеры изменяющие form
        // наблюдает за списком свойств и поддерживает актуальность form.properties
        properties: {
          // наблюдаемое свойство меняется при апдейте arResult и изменяет
          handler: function handler(properties) {
            if (properties) {
              for (var i in this.properties) {
                var property = this.properties[i];
                if (this.form.properties[property.FIELDNAME] != property.VALUE[0]) {
                  //console.log(property.FIELDNAME, this.form.properties[property.FIELDNAME], property.VALUE[0]);
                  if (property.VALUE[0] && property.VALUE[0] != 'undefined') {
                    this.form.properties[property.FIELDNAME] = property.VALUE[0];
                  } else {
                    this.form.properties[property.FIELDNAME] = '';
                  }
                }
              }
            }
          },
          deep: true
        },
        paysystem: {
          handler: function handler(val, oval) {
            if (val && this.form.PAYSYSTEM != val.ID) {
              console.log('устанавливаем PAYSYSTEM');
              this.form.PAYSYSTEM = val.ID;
            }
          },
          deep: true
        },
        delivery: {
          handler: function handler(val, oval) {
            if (val && this.form.DELIVERY != val.ID) {
              console.log('устанавливаем DELIVERY');
              this.form.DELIVERY = val.ID;
            }
          },
          deep: true
        },
        store: {
          handler: function handler(val, oval) {
            if (val && this.form.BUYER_STORE != val.ID) {
              this.form.BUYER_STORE = val.ID;
            }
          },
          deep: true
        }
        // вотчеры изменяющие form
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      },
      created: function created() {
        // переносим инициализационные данные
        this.hashBasket = this.initdata.hashBasket;
        this.arResult = this.initdata.arResult;

        // загружаем в form значения из arResult
        this.reloadResult();
      },
      mounted: function mounted() {
        // запускаем обновление данных,
        // при обновлении DELIVERY, PAYSYSTEM и LOCATION
        this.$watch('form.DELIVERY', function (val, oval) {
          console.log('form.DELIVERY', val, oval);
          if (val != oval) this.updateData();
        });
        this.$watch('form.PAYSYSTEM', function (val, oval) {
          console.log('form.PAYSYSTEM', val, oval);
          if (val != oval) this.updateData();
        });
        this.$watch('form.properties.LOCATION', function (val, oval) {
          console.log('form.properties.LOCATION', val, oval);
          if (typeof val == 'string' && val != oval) this.updateData();
        });
      },
      methods: {
        $_getQueryData: function $_getQueryData() {
          return {
            'sessid': BX.bitrix_sessid(),
            'site_id': BX.message('SITE_ID'),
            'via_ajax': 'Y',
            'signedParamsString': this.initdata.signedParamsString
          };
        },
        $_getFormData: function $_getFormData(full) {
          full = full || false;
          var order = {
            'location_type': 'code' // костыль локация - без него не работает
          };

          // свойства заказа
          for (var i in this.properties) {
            var property = this.properties[i];
            if (full || property.VALUE[0] != this.form.properties[property.FIELDNAME]) {
              order[property.SENDNAME] = this.form.properties[property.FIELDNAME];
            }
          }

          // доставка
          if (full || this.form.DELIVERY != this.delivery.ID) {
            // добавляем только если есть смысл
            for (var id in this.deliveries) {
              var delivery = this.deliveries[id];
              if (delivery.ID == this.form.DELIVERY) {
                order[delivery.FIELD_NAME] = this.form.DELIVERY;
                break;
              }
            }
          }

          // платежная система
          if (full || this.form.PAYSYSTEM != this.paysystem.ID) {
            // добавляем только если есть смысл
            order.PAY_SYSTEM_ID = this.form.PAYSYSTEM;
          }

          // комментарий
          if (this.form.ORDER_DESCRIPTION) {
            order.ORDER_DESCRIPTION = this.form.ORDER_DESCRIPTION;
          }
          return order;
        },
        basketchange: function basketchange(hash) {
          if (this.hashBasket != hash) {
            // новый хэш
            this.updateData();
            this.hashBasket = hash; // запоминаем что для этой корзины мы уже запросили данные
          } // else - мы уже знаем об этой корзине
        },
        // изменяем данные из резалт
        // TODO: перевести сюда доставки и оплаты
        reloadResult: function reloadResult() {
          if (this.arResult) {
            if (this.arResult.BUYER_STORE) {
              this.form.BUYER_STORE = this.arResult.BUYER_STORE;
            }
          }
        },
        updateData: function updateData() {
          console.log('updateData?');
          var vm = this;
          if (this.basketEmpty) {
            // сбросим данные
            vm.arResult = {};
          } else {
            console.log('------------------------------------ update ------------------------------------');
            vm.reflection.updateData = vm.reflection.updateData + 1;
            setTimeout(function () {
              vm.reflection.updateData = vm.reflection.updateData - 1;
            }, 8000);
            if (vm.reflection.updateData > 8) {
              console.error('update recursion');
              return;
            }
            vm.exchange = vm.exchange + 1;
            var sendData = this.$_getQueryData(true);
            sendData.action = 'refreshOrderAjax';
            sendData.order = this.$_getFormData(true);
            BX.ajax({
              url: this.initdata.ajaxUrl,
              method: 'POST',
              dataType: 'json',
              data: sendData,
              onsuccess: function onsuccess(result) {
                console.log(result);
                if (result.error) {
                  iziToast.error({
                    timeout: 6000,
                    title: 'Что-то пошло не так',
                    message: 'попробуйте обновить страницу'
                  });
                } else if (result.order) {
                  // обновляем значения в arResult
                  for (var k in result.order) {
                    // на случай если придут не все ключи
                    vm.arResult[k] = result.order[k];
                  }
                  vm.reloadResult(); // и запускаем загрузку из них
                } else {
                  iziToast.error({
                    timeout: 6000,
                    title: 'Что-то пошло cовсем не так',
                    message: 'попробуйте обновить страницу'
                  });
                }
                if (vm.exchange > 0) vm.exchange = vm.exchange - 1;
                BX.onCustomEvent('x.vue.loader:initVue'); // если есть компоненты внутри формы
              },
              onfailure: function onfailure() {
                iziToast.error({
                  timeout: 6000,
                  title: 'Ошибка',
                  message: 'проблемы на сервере'
                });
                if (vm.exchange > 0) vm.exchange = vm.exchange - 1;
              }
            });
          }
        },
        save: function save() {
          var vm = this;

          // if (!vm.agreement) {

          //     iziToast.warning({
          //         timeout: 4000,
          //         //title: title, 
          //         message: 'Вы должны согласится с условиями использования сайта'
          //     });
          //     return;
          // }

          vm.exchange = vm.exchange + 1;
          var sendData = this.$_getQueryData(true);
          sendData.action = 'saveOrderAjax';
          Object.assign(sendData, this.$_getFormData(true));
          BX.ajax({
            url: this.initdata.ajaxUrl,
            method: 'POST',
            dataType: 'json',
            data: sendData,
            onsuccess: function onsuccess(result) {
              console.log(result);
              if (result.order) {
                var order = result.order;
                if (order.ERROR) {
                  var _loop = function _loop() {
                    var errors = order.ERROR[CLASS];
                    var title = '';
                    var advice = '';
                    if (CLASS == 'AUTH') {
                      title = 'Ошибка регистрации';
                    } else if (CLASS == 'PROPERTY') {
                      title = 'Ошибка оформления заказа';
                      advice = 'Заполните обязательные поля';
                    } else {
                      title = 'Ошибка';
                    }
                    var _loop2 = function _loop2() {
                      var errorMessage = errors[i];
                      setTimeout(function () {
                        iziToast.error({
                          timeout: 4000,
                          title: title,
                          message: errorMessage + '<br>' + advice
                        });
                      }, i * 1000);
                    };
                    for (var i in errors) {
                      _loop2();
                    }
                  };
                  for (var CLASS in order.ERROR) {
                    _loop();
                  }
                } else if (order.ID && order.REDIRECT_URL) {
                  //console.log('OnOrderComplete', {id: order.ID});
                  BX.onCustomEvent('OnOrderComplete', {
                    id: order.ID
                  });
                  iziToast.success({
                    timeout: 4000,
                    //title: title, 
                    message: 'Заказ ' + order.ID + ' оформлен'
                  });
                  location.href = order.REDIRECT_URL;
                } else {
                  iziToast.error({
                    timeout: 6000,
                    title: 'Ошибка',
                    message: 'Похоже произошла непредвиденная ошибка'
                  });
                }
              }
              if (vm.exchange > 0) vm.exchange = vm.exchange - 1;
            },
            onfailure: function onfailure() {
              iziToast.error({
                timeout: 6000,
                title: 'Ошибка',
                message: 'Что-то пошло совсем не так'
              });
              if (vm.exchange > 0) vm.exchange = vm.exchange - 1;
            }
          });
        },
        $_validate: function $_validate(lstProps) {
          //console.log('ВАЛИДАЦИЯ',JSON.stringify(lstProps));
          var result = true;
          for (var i in lstProps) {
            var property = lstProps[i];
            if (property.REQUIRED == 'Y' && !this.form.properties[property.FIELDNAME]) {
              this.errors.properties[property.FIELDNAME] = {
                value: this.form.properties[property.FIELDNAME],
                error: 'Это поле обязательно для заполнения.'
              };
              result = false;
            }
          }
          return result;
        }
      },
      template: /*vue-html*/"\n    <div class=\"container container--type-5\">\n        <div class=\"row\">\n\n            <div class=\"col-lg\">\n\n                <slot name=\"go2cart\"></slot>\n                \n\n                <div class=\"d-md-none d-block mb-4\">\n                    <BasketMinimal\n                            v-bind:total=\"total\"\n                            v-bind:conex=\"conex\"\n                            v-on:basketchange=\"basketchange\"\n                        />\n                </div>\n\n                <slot name=\"expresscheckout\"></slot>\n                \n                <div class=\"checkout-or\">\n                    <span>OR</span>\n                </div>\n\n                <div class=\"input-group mb-md-4 mb-5\">\n                    <div class=\"row align-items-center mb-lg-1 mb-3\">\n                        <div class=\"col\">\n                            <div class=\"input-group__title\">\n                                Contact\n                            </div>\n                        </div>\n                        <div class=\"col-auto\">\n                            <slot name=\"auth\"></slot>\n                        </div>\n                    </div>\n\n                    <label for=\"\" class=\"input\">\n                        <input type=\"email\" v-model=\"form.properties.EMAIL\">\n                        <span class=\"input__label\">\n                            Email\n                        </span>\n                    </label>\n                </div>\n                <div class=\"input-group mb-md-4 mb-5\">\n                    <div class=\"input-group__title mb-lg-1 mb-3\">\n                        Delivery\n                    </div>\n                    <div class=\"row\">\n                        <div class=\"col mb-3\">\n                            <label for=\"\" class=\"input\">\n                                <input type=\"text\" v-model=\"form.properties.NAME\">\n                                <span class=\"input__label\">\n                                    First name (optional)\n                                </span>\n                            </label>\n                        </div>\n                        <div class=\"col mb-3\">\n                            <label for=\"\" class=\"input\">\n                                <input type=\"text\" v-model=\"form.properties.LASTNAME\">\n                                <span class=\"input__label\">\n                                    Last name\n                                </span>\n                            </label>\n                        </div>\n                    </div>\n\n                    <div class=\"col-lg-12 col-6 mb-3\">\n                        <label for=\"\" class=\"input\">\n                            <input type=\"text\" v-model=\"form.properties.PHONE\">\n                            <span class=\"input__label\">\n                                Phone\n                            </span>\n                            <span class=\"input__icon\">\n                                <svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\"\n                                    xmlns=\"http://www.w3.org/2000/svg\">\n                                    <g clip-path=\"url(#clip0_134_896)\">\n                                        <path\n                                            d=\"M21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21C16.9706 21 21 16.9706 21 12Z\"\n                                            stroke=\"#9C9CA9\" stroke-width=\"1.5\" stroke-linecap=\"round\"\n                                            stroke-linejoin=\"round\" />\n                                        <path\n                                            d=\"M14 9.83002C14 8.73002 13.1 7.83002 12 7.83002C10.9 7.83002 10 8.73002 10 9.83002\"\n                                            stroke=\"#9C9CA9\" stroke-width=\"1.5\" stroke-linecap=\"round\"\n                                            stroke-linejoin=\"round\" />\n                                        <path\n                                            d=\"M12 15C11.44 15 11 15.44 11 16C11 16.56 11.44 17 12 17C12.56 17 13 16.56 13 16C13 15.44 12.56 15 12 15Z\"\n                                            fill=\"#9C9CA9\" />\n                                        <path d=\"M13.9998 9.83002C13.9998 10.63 13.5098 11.06 13.0098 11.4\"\n                                            stroke=\"#9C9CA9\" stroke-width=\"1.5\" stroke-linecap=\"round\"\n                                            stroke-linejoin=\"round\" />\n                                        <path d=\"M12 13C12 12.18 12.51 11.74 13.01 11.4\" stroke=\"#9C9CA9\"\n                                            stroke-width=\"1.5\" stroke-linecap=\"round\"\n                                            stroke-linejoin=\"round\" />\n                                        <path d=\"M12 13V13.25\" stroke=\"#9C9CA9\" stroke-width=\"1.5\"\n                                            stroke-linecap=\"round\" stroke-linejoin=\"round\" />\n                                    </g>\n                                    <defs>\n                                        <clipPath id=\"clip0_134_896\">\n                                            <rect width=\"24\" height=\"24\" fill=\"white\" />\n                                        </clipPath>\n                                    </defs>\n                                </svg>\n                            </span>\n                        </label>\n                    </div>\n\n                    <div class=\"row\">\n                        <div class=\"col mb-3\">\n                            <label for=\"\" class=\"input\">\n                                <input type=\"text\" v-model=\"form.properties.CITY\">\n                                <span class=\"input__label\">\n                                    City\n                                </span>\n                            </label>\n                        </div>\n                        <div class=\"col mb-3\">\n                            <label for=\"\" class=\"input\">\n                                <input type=\"text\" v-model=\"form.properties.ZIP\">\n                                <span class=\"input__label\">\n                                    ZIP code\n                                </span>\n                            </label>\n                        </div>\n                        \n                    </div>\n\n                    <label for=\"\" class=\"input\">\n                        <input type=\"text\" v-model=\"form.properties.ADDRESS\">\n                        <span class=\"input__label\">\n                            Address\n                        </span>\n                    </label>\n\n                </div>\n                <div class=\"input-group mb-md-4 mb-5\">\n                    <div class=\"input-group__title mb-4 mb-md-1\">\n                        Shipping method\n                    </div>\n\n\n                    <label \n                            class=\"checkout-radio\" \n                            v-for=\"delivereg in deliveries\" \n                            v-bind:key=\"'delivery_'+delivereg.ID\"\n                            v-bind:for=\"'input_delivery_'+delivereg.ID\"\n                        >\n                        <input type=\"radio\" name=\"DELIVERY_ID\" \n                                v-bind:id=\"'input_delivery_'+delivereg.ID\"\n                                v-bind:value=\"delivereg.ID\" \n                                v-model=\"form.DELIVERY\"\n                            >\n                        <span class=\"checkout-radio__label\">\n                            <div class=\"checkout-radio__input\"></div>\n                            <div class=\"checkout-radio__value\">\n                                <img v-if=\"delivereg.LOGOTIP?.SRC\" v-bind:src=\"delivereg.LOGOTIP.SRC\" alt=\"\">\n                                {{delivereg.OWN_NAME}}\n                            </div>\n                            <div class=\"checkout-radio__right\">\n                                <strong\n                                        v-if=\"delivereg?.PRICE\"\n                                        v-html=\"delivereg.PRICE_FORMATED\"\n                                    ></strong>\n                                <strong\n                                        v-else\n                                    >Free</strong>\n                            </div>\n                        </span>\n                    </label>\n                </div>\n                <div class=\"input-group mb-md-4 mb-5\">\n                    <div class=\"input-group__title\">\n                        Payment\n                    </div>\n                    <span class=\"input-group__text\">All transactions are secure and encrypted</span>\n\n\n                    <label class=\"checkout-radio\" \n                            v-for=\"paysystem in paysystems\" \n                            v-bind:key=\"'paysystem_'+paysystem.ID\"\n                            v-bind:for=\"'input_paysystem_'+paysystem.ID\"\n                        >\n                        <input type=\"radio\" name=\"PAY_SYSTEM_ID\" \n                                v-model=\"form.PAYSYSTEM\" \n                                v-bind:value=\"paysystem.ID\"\n                                v-bind:id=\"'input_paysystem_'+paysystem.ID\"\n                            >\n                        <span class=\"checkout-radio__label\">\n                            <div class=\"checkout-radio__input\">\n\n                            </div>\n                            <div class=\"checkout-radio__value\">\n                                {{paysystem.PSA_NAME}}\n                            </div>\n                            <div class=\"checkout-radio__right\" v-if=\"paysystem.PSA_LOGOTIP?.SRC\">\n                                <img v-bind:src=\"paysystem.PSA_LOGOTIP.SRC\" alt=\"\">\n                            </div>\n                        </span>\n                    </label>\n                </div>\n                \n                <div class=\"d-md-none d-block mb-5\">\n                    <div class=\"mobile-checkout\">\n                        <div class=\"row\">\n                            <div class=\"col-auto\">\n                                <div class=\"mobile-checkout__count\">\n                                    3 items\n                                </div>\n                            </div>\n                            <div class=\"col\">\n                                <div class=\"mobile-checkout__details\">\n                                    <div class=\"row mb-3\">\n                                        <div class=\"col\">\n                                            <div class=\"mobile-checkout__info\">\n                                                <div>Subtotal: <strong>$2856.00</strong></div>\n                                                <div>Shipping: Free</div>\n                                                <div>Total: <strong><span>$2856.00</span></strong></div>\n                                            </div>\n                                        </div>\n                                        <div class=\"col-auto\">\n                                            <a href=\"#\">Edit</a>\n                                        </div>\n                                    </div>\n                                    <div class=\"position-relative footer__newsleter\">\n                                        <input type=\"email\" class=\"footer__newsleter-input\"\n                                            placeholder=\"Discount code or gift card\">\n                                        <button><svg width=\"18\" height=\"14\" viewBox=\"0 0 18 14\" fill=\"none\"\n                                                xmlns=\"http://www.w3.org/2000/svg\">\n                                                <path d=\"M1.47998 6.97998H16.47\" stroke-width=\"1.5\"\n                                                    stroke-linecap=\"round\" stroke-linejoin=\"round\"></path>\n                                                <path d=\"M10.48 0.98999L16.52 6.99999L10.48 13.01\"\n                                                    stroke-width=\"1.5\" stroke-linecap=\"round\"\n                                                    stroke-linejoin=\"round\"></path>\n                                            </svg></button>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n                <button class=\"second-button checkout-button mb-5 mb-md-0\" v-on:click=\"save\">Pay Now</button>\n\n            </div>\n            <div class=\"col-lg-auto pt-2 d-md-block d-none\">\n                <BasketSide\n                        v-bind:total=\"total\"\n                        v-bind:conex=\"conex\"\n                        v-on:basketchange=\"basketchange\"\n                    />\n            </div>\n        </div>\n\n    </div>\n\n    <div class=\"cover\" v-if=\"exchange\"></div>\n\t"
    };

    exports.Order = Order;

}((this.BX.App.Vue.Components = this.BX.App.Vue.Components || {}),BX,BX,BX));
//# sourceMappingURL=s.js.map
