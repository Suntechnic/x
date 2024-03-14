import './order.css';

import 'x.vue.components.ui';
let PhoneInput = BX.X.Vue.Components.PhoneInput;
let Selector = BX.X.Vue.Components.Selector;

import 'x.izi'; let iziToast = BX.X.iziToast;
import { Currency } from 'currency';

import 'app.vue.components.basket.minimal'; let BasketMinimal = BX.App.Vue.Components.BasketMinimal;
import 'app.vue.components.basket.side'; let BasketSide = BX.App.Vue.Components.BasketSide;

console.log(BasketSide);

export const Order = {
    components: {
        BasketMinimal: BasketMinimal,
        BasketSide: BasketSide,
        PhoneInput: PhoneInput,
        Selector: Selector
    },
    inject: ['initdata','dictionaries'],
    data() {
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
                properties: {

                }
            },

            errors: {
                ORDER_DESCRIPTION: '',
                DELIVERY: '',
                PAYSYSTEM: '',
                properties: {

                }
            },

            state: {
                step: 2,
                lang: false
            },

            reflection: {
                updateData: 0,
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
            map: [
                {
                    condition: {
                        key: 'IS_LOCATION',
                        val: 'Y'
                    },
                    fieldname: 'LOCATION'
                },
                {
                    condition: {
                        key: 'IS_PHONE',
                        val: 'Y'
                    },
                    fieldname: 'PHONE'
                },
                {
                    condition: {
                        key: 'IS_EMAIL',
                        val: 'Y'
                    },
                    fieldname: 'EMAIL'
                },
                {
                    condition: {
                        key: 'CODE',
                        val: 'NAME'
                    },
                    fieldname: 'NAME'
                },
                {
                    condition: {
                        key: 'IS_PAYER',
                        val: 'Y'
                    },
                    fieldname: 'LASTNAME'
                },
                {
                    condition: {
                        key: 'IS_ZIP',
                        val: 'Y'
                    },
                    fieldname: 'ZIP'
                },
                {
                    condition: {
                        key: 'CODE',
                        val: 'CITY'
                    },
                    fieldname: 'CITY'
                },
                {
                    condition: {
                        key: 'IS_ADDRESS',
                        val: 'Y'
                    },
                    fieldname: 'ADDRESS'
                },
                {
                    condition: {
                        key: 'CODE',
                        val: 'DESCRIPTION'
                    },
                    fieldname: 'DESCRIPTION'
                }
            ]
        }
    },
    computed: {


        basketEmpty () {
            return false;
            return !(this.$store.state.basket?.items?.length);
        },



        // реорганизация
        properties() { // список свойств - изменяется при апдейте arResult, в т.ч. 
                        // в процесс периодических изменений
            let properties = [];

            if (this.arResult?.ORDER_PROP?.properties) {
                properties = JSON.parse(JSON.stringify(this.arResult.ORDER_PROP.properties));

                for (let i in properties) {
                    let property = properties[i];

                    property.SENDNAME = 'ORDER_PROP_' + property.ID
                    property.MAPED = false;
                    for (let i in this.map) {
                        let maping = this.map[i];
                        if (property[maping.condition.key] == maping.condition.val) {
                            property.FIELDNAME = maping.fieldname;
                            property.MAPED = true;
                            break;
                        }
                    }
                    if (!property.MAPED) property.FIELDNAME = property.SENDNAME

                }
            }


            return properties;
        },
        propertiesUnmaped() {
            let propertiesUnmaped = [];

            for (let i in this.properties) {
                let property = this.properties[i];
                if (!property.MAPED) propertiesUnmaped.push(property);
            }

            return propertiesUnmaped;
        },
    



        locations() { // список местоположений

            let locations = [];

            if (this.arResult?.LOCATION) {
                //locations = JSON.parse(JSON.stringify(this.arResult.LOCATION));
                Object.entries(this.arResult.LOCATION).forEach(([key, value]) => {
                    locations.push({ code: value, title: key })
                })
            }

            return locations;
        },
        paysystems() { // список платежных систем

            let paysystems = {};

            if (this.arResult?.PAY_SYSTEM) {
                paysystems = JSON.parse(JSON.stringify(this.arResult.PAY_SYSTEM));
            }


            return paysystems;
        },
        paysystem() { // выбранная система
            for (let i in this.paysystems) {
                if (this.paysystems[i].CHECKED == 'Y') {
                    return this.paysystems[i];
                }
            }
        },
        deliveries() { // список доставок

            let deliveries = {};

            if (this.arResult?.DELIVERY) {
                deliveries = JSON.parse(JSON.stringify(this.arResult.DELIVERY));
                // преобразования
                for (let id in deliveries) {
                    deliveries[id].PRICE_FORMATED = Currency.currencyFormat(
                        deliveries[id].PRICE,
                        deliveries[id].CURRENCY,
                        true
                    );
                }
            }

            return deliveries;
        },
        delivery() { // выбранная доставка берется из доставки отмеченной Y, которая обновляется при обновлении this.arResult
            for (let id in this.deliveries) {
                if (this.deliveries[id].CHECKED == 'Y') {
                    return this.deliveries[id];
                }
            }
        },
        deliveryStores() { // выбранная доставка
            let stores = false;
            if (this.delivery?.STORE?.length) {
                stores = [];
                for (let i in this.delivery.STORE) {
                    let StoreId = this.delivery.STORE[i];
                    stores.push(JSON.parse(JSON.stringify(this.arResult.STORE_LIST[StoreId])));

                }
            }
            return stores;
        },
        store() {
            if (this.form.BUYER_STORE) {
                return this.arResult.STORE_LIST[this.form.BUYER_STORE]
            }
            return false;
        },
        displayedDeliveryAddress() {
            if (this.store) {
                return this.store.ADDRESS;
            } else {
                let addressTokens = [];
                for (let i in this.propertiesUserPropsDelivery) {
                    let val = this.form.properties[this.propertiesUserPropsDelivery[i].FIELDNAME];
                    if (val) addressTokens.push(val);

                }
                return addressTokens.join(', ');
            }
        },

        total() {

            let total = {};
            if (this.arResult?.TOTAL) {
                total = JSON.parse(JSON.stringify(this.arResult.TOTAL));

            } else {
                total = {
                    BASKET_POSITIONS: 0,
                    ORDER_TOTAL_PRICE: 0
                };
            }
            // преобразования
            if (typeof total.ORDER_TOTAL_PRICE != 'undefined') {
                total.ORDER_TOTAL_PRICE_FORMATED = Currency.currencyFormat(total.ORDER_TOTAL_PRICE, 'USD', true);
            } else {
                total.ORDER_TOTAL_PRICE_FORMATED = '';
            }


            return total;
        },

        // сопутствующие расходы
        conex() {
            let conex = [];

            conex.push({
                'title': 'Shipping',
                'price': this.total.DELIVERY_PRICE,
                'priceformated': Currency.currencyFormat(this.total.DELIVERY_PRICE, 'USD', true) // this.total.DELIVERY_PRICE_FORMATED,
            });

            return conex;
        },

    },
    watch: {
        exchange: {
            handler(val, oval) {
                if (val && !oval) {
                    
                } else if (!val && oval) {
                    
                }
            }
        },
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // вотчеры изменяющие errors
        form: {
            // следим за форм, и если текущее значение свойства, отличается от ошиюбочного - гасим ошибку
            handler(form) {
                if (this.properties) {
                    for (let i in this.properties) {
                        let property = this.properties[i];
                        if (typeof this.errors.properties[property.FIELDNAME] != 'undefined') {
                            // в этом свойстве есть ошибка
                            if (this.errors.properties[property.FIELDNAME].value
                                != this.form.properties[property.FIELDNAME]
                            ) delete this.errors.properties[property.FIELDNAME]; // гасим ее
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
            handler(properties) {
                if (properties) {
                    for (let i in this.properties) {
                        let property = this.properties[i];
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
            handler(val, oval) {
                if (val && this.form.PAYSYSTEM != val.ID) {
                    console.log('устанавливаем PAYSYSTEM');
                    this.form.PAYSYSTEM = val.ID
                }
            },
            deep: true
        },
        delivery: {
            handler(val, oval) {
                if (val && this.form.DELIVERY != val.ID) {
                    console.log('устанавливаем DELIVERY');
                    this.form.DELIVERY = val.ID
                }
            },
            deep: true
        },
        store: {
            handler(val, oval) {
                if (val && this.form.BUYER_STORE != val.ID) {
                    this.form.BUYER_STORE = val.ID
                }
            },
            deep: true
        },
        // вотчеры изменяющие form
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    },
    created() {
        // переносим инициализационные данные
        this.hashBasket = this.initdata.hashBasket;
        this.arResult = this.initdata.arResult;

        // загружаем в form значения из arResult
        this.reloadResult();

    },
    mounted() {
        // запускаем обновление данных,
        // при обновлении DELIVERY, PAYSYSTEM и LOCATION
        this.$watch('form.DELIVERY', function (val, oval) {
            console.log('form.DELIVERY',val, oval);
            if (val != oval) this.updateData();
        });
        this.$watch('form.PAYSYSTEM', function (val, oval) {
            console.log('form.PAYSYSTEM',val, oval);
            if (val != oval) this.updateData();
        });
        this.$watch('form.properties.LOCATION', function (val, oval) {
            console.log('form.properties.LOCATION',val, oval);
            if (typeof val == 'string' && val != oval) this.updateData();
        });

    },
    methods: {
        $_getQueryData() {
            return {
                'sessid': BX.bitrix_sessid(),
                'site_id': BX.message('SITE_ID'),
                'via_ajax': 'Y',
                'signedParamsString': this.initdata.signedParamsString,
            };
        },
        $_getFormData(full) {
            full = full || false;

            let order = {
                'location_type': 'code' // костыль локация - без него не работает
            }

            // свойства заказа
            for (let i in this.properties) {
                let property = this.properties[i];
                if (full || property.VALUE[0] != this.form.properties[property.FIELDNAME]) {
                    order[property.SENDNAME] = this.form.properties[property.FIELDNAME];
                }
            }

            // доставка
            if (full || this.form.DELIVERY != this.delivery.ID) { // добавляем только если есть смысл
                for (let id in this.deliveries) {
                    let delivery = this.deliveries[id];
                    if (delivery.ID == this.form.DELIVERY) {
                        order[delivery.FIELD_NAME] = this.form.DELIVERY;
                        break;
                    }
                }
            }

            // платежная система
            if (full || this.form.PAYSYSTEM != this.paysystem.ID) { // добавляем только если есть смысл
                order.PAY_SYSTEM_ID = this.form.PAYSYSTEM;
            }

            // комментарий
            if (this.form.ORDER_DESCRIPTION) {
                order.ORDER_DESCRIPTION = this.form.ORDER_DESCRIPTION;
            }


            return order;
        },
        basketchange(hash) {

            if (this.hashBasket != hash) { // новый хэш
                this.updateData();
                this.hashBasket = hash; // запоминаем что для этой корзины мы уже запросили данные
            } // else - мы уже знаем об этой корзине
        },

        // изменяем данные из резалт
        // TODO: перевести сюда доставки и оплаты
        reloadResult() {
            if (this.arResult) {
                if (this.arResult.BUYER_STORE) {
                    this.form.BUYER_STORE = this.arResult.BUYER_STORE;
                }
            }
        },

        updateData() {


            console.log('updateData?');
            let vm = this;

            if (this.basketEmpty) {
                // сбросим данные
                vm.arResult = {};
            } else {
                console.log('------------------------------------ update ------------------------------------');

                vm.reflection.updateData = vm.reflection.updateData+1;
                setTimeout(()=>{vm.reflection.updateData = vm.reflection.updateData-1;},8000)
                if (vm.reflection.updateData > 8) {
                    console.error('update recursion');
                    return; 
                }

                vm.exchange = vm.exchange + 1;

                let sendData = this.$_getQueryData(true);
                sendData.action = 'refreshOrderAjax';
                sendData.order = this.$_getFormData(true);

                BX.ajax(
                    {
                        url: this.initdata.ajaxUrl,
                        method: 'POST',
                        dataType: 'json',
                        data: sendData,
                        onsuccess: function (result) {

                            console.log(result);

                            if (result.error) {
                                iziToast.error({
                                    timeout: 6000,
                                    title: 'Что-то пошло не так',
                                    message: 'попробуйте обновить страницу'
                                });
                            } else if (result.order) {
                                // обновляем значения в arResult
                                for (let k in result.order) { // на случай если придут не все ключи
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
                        onfailure: function () {
                            iziToast.error({
                                timeout: 6000,
                                title: 'Ошибка',
                                message: 'проблемы на сервере'
                            });
                            if (vm.exchange > 0) vm.exchange = vm.exchange - 1;
                        },
                    }
                );
            }
        },
        save() {

            let vm = this;

            // if (!vm.agreement) {

            //     iziToast.warning({
            //         timeout: 4000,
            //         //title: title, 
            //         message: 'Вы должны согласится с условиями использования сайта'
            //     });
            //     return;
            // }

            vm.exchange = vm.exchange + 1;

            let sendData = this.$_getQueryData(true);
            sendData.action = 'saveOrderAjax';
            Object.assign(sendData, this.$_getFormData(true));

            BX.ajax(
                {
                    url: this.initdata.ajaxUrl,
                    method: 'POST',
                    dataType: 'json',
                    data: sendData,
                    onsuccess: function (result) {
                        console.log(result);
                        if (result.order) {
                            let order = result.order;
                            if (order.ERROR) {
                                for (let CLASS in order.ERROR) {
                                    let errors = order.ERROR[CLASS]
                                    let title = '';
                                    let advice = '';

                                    if (CLASS == 'AUTH') {
                                        title = 'Ошибка регистрации';
                                    } else if (CLASS == 'PROPERTY') {
                                        title = 'Ошибка оформления заказа';
                                        advice = 'Заполните обязательные поля';
                                    } else {
                                        title = 'Ошибка';
                                    }

                                    for (let i in errors) {
                                        let errorMessage = errors[i];
                                        setTimeout(() => {
                                            iziToast.error({
                                                timeout: 4000,
                                                title: title,
                                                message: errorMessage + '<br>' + advice
                                            });
                                        }, i * 1000);
                                    }
                                }
                            } else if (order.ID && order.REDIRECT_URL) {
                                //console.log('OnOrderComplete', {id: order.ID});
                                BX.onCustomEvent('OnOrderComplete', { id: order.ID });
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
                    onfailure: function () {
                        iziToast.error({
                            timeout: 6000,
                            title: 'Ошибка',
                            message: 'Что-то пошло совсем не так'
                        });
                        if (vm.exchange > 0) vm.exchange = vm.exchange - 1;
                    },
                }
            );
        },
        $_validate(lstProps) {
            //console.log('ВАЛИДАЦИЯ',JSON.stringify(lstProps));
            let result = true;
            for (let i in lstProps) {
                let property = lstProps[i];
                if (property.REQUIRED == 'Y' && !this.form.properties[property.FIELDNAME]) {
                    this.errors.properties[property.FIELDNAME] = {
                        value: this.form.properties[property.FIELDNAME],
                        error: 'Это поле обязательно для заполнения.'
                    }
                    result = false;
                }
            }
            return result;
        }
    },
    template: /*vue-html*/`
    <div class="container container--type-5">
        <div class="row">

            <div class="col-lg">

                <slot name="go2cart"></slot>
                

                <div class="d-md-none d-block mb-4">
                    <BasketMinimal
                            v-bind:total="total"
                            v-bind:conex="conex"
                            v-on:basketchange="basketchange"
                        />
                </div>

                <slot name="expresscheckout"></slot>
                
                <div class="checkout-or">
                    <span>OR</span>
                </div>

                <div class="input-group mb-md-4 mb-5">
                    <div class="row align-items-center mb-lg-1 mb-3">
                        <div class="col">
                            <div class="input-group__title">
                                Contact
                            </div>
                        </div>
                        <div class="col-auto">
                            <slot name="auth"></slot>
                        </div>
                    </div>

                    <label for="" class="input">
                        <input type="email" v-model="form.properties.EMAIL">
                        <span class="input__label">
                            Email
                        </span>
                    </label>
                </div>
                <div class="input-group mb-md-4 mb-5">
                    <div class="input-group__title mb-lg-1 mb-3">
                        Delivery
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="" class="input">
                                <input type="text" v-model="form.properties.NAME">
                                <span class="input__label">
                                    First name (optional)
                                </span>
                            </label>
                        </div>
                        <div class="col mb-3">
                            <label for="" class="input">
                                <input type="text" v-model="form.properties.LASTNAME">
                                <span class="input__label">
                                    Last name
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-6 mb-3">
                        <label for="" class="input">
                            <input type="text" v-model="form.properties.PHONE">
                            <span class="input__label">
                                Phone
                            </span>
                            <span class="input__icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_134_896)">
                                        <path
                                            d="M21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21C16.9706 21 21 16.9706 21 12Z"
                                            stroke="#9C9CA9" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M14 9.83002C14 8.73002 13.1 7.83002 12 7.83002C10.9 7.83002 10 8.73002 10 9.83002"
                                            stroke="#9C9CA9" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 15C11.44 15 11 15.44 11 16C11 16.56 11.44 17 12 17C12.56 17 13 16.56 13 16C13 15.44 12.56 15 12 15Z"
                                            fill="#9C9CA9" />
                                        <path d="M13.9998 9.83002C13.9998 10.63 13.5098 11.06 13.0098 11.4"
                                            stroke="#9C9CA9" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M12 13C12 12.18 12.51 11.74 13.01 11.4" stroke="#9C9CA9"
                                            stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M12 13V13.25" stroke="#9C9CA9" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_134_896">
                                            <rect width="24" height="24" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span>
                        </label>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="" class="input">
                                <input type="text" v-model="form.properties.CITY">
                                <span class="input__label">
                                    City
                                </span>
                            </label>
                        </div>
                        <div class="col mb-3">
                            <label for="" class="input">
                                <input type="text" v-model="form.properties.ZIP">
                                <span class="input__label">
                                    ZIP code
                                </span>
                            </label>
                        </div>
                        
                    </div>

                    <label for="" class="input">
                        <input type="text" v-model="form.properties.ADDRESS">
                        <span class="input__label">
                            Address
                        </span>
                    </label>

                </div>
                <div class="input-group mb-md-4 mb-5">
                    <div class="input-group__title mb-4 mb-md-1">
                        Shipping method
                    </div>


                    <label 
                            class="checkout-radio" 
                            v-for="delivereg in deliveries" 
                            v-bind:key="'delivery_'+delivereg.ID"
                            v-bind:for="'input_delivery_'+delivereg.ID"
                        >
                        <input type="radio" name="DELIVERY_ID" 
                                v-bind:id="'input_delivery_'+delivereg.ID"
                                v-bind:value="delivereg.ID" 
                                v-model="form.DELIVERY"
                            >
                        <span class="checkout-radio__label">
                            <div class="checkout-radio__input"></div>
                            <div class="checkout-radio__value">
                                <img v-if="delivereg.LOGOTIP?.SRC" v-bind:src="delivereg.LOGOTIP.SRC" alt="">
                                {{delivereg.OWN_NAME}}
                            </div>
                            <div class="checkout-radio__right">
                                <strong
                                        v-if="delivereg?.PRICE"
                                        v-html="delivereg.PRICE_FORMATED"
                                    ></strong>
                                <strong
                                        v-else
                                    >Free</strong>
                            </div>
                        </span>
                    </label>
                </div>
                <div class="input-group mb-md-4 mb-5">
                    <div class="input-group__title">
                        Payment
                    </div>
                    <span class="input-group__text">All transactions are secure and encrypted</span>


                    <label class="checkout-radio" 
                            v-for="paysystem in paysystems" 
                            v-bind:key="'paysystem_'+paysystem.ID"
                            v-bind:for="'input_paysystem_'+paysystem.ID"
                        >
                        <input type="radio" name="PAY_SYSTEM_ID" 
                                v-model="form.PAYSYSTEM" 
                                v-bind:value="paysystem.ID"
                                v-bind:id="'input_paysystem_'+paysystem.ID"
                            >
                        <span class="checkout-radio__label">
                            <div class="checkout-radio__input">

                            </div>
                            <div class="checkout-radio__value">
                                {{paysystem.PSA_NAME}}
                            </div>
                            <div class="checkout-radio__right" v-if="paysystem.PSA_LOGOTIP?.SRC">
                                <img v-bind:src="paysystem.PSA_LOGOTIP.SRC" alt="">
                            </div>
                        </span>
                    </label>
                </div>
                
                <div class="d-md-none d-block mb-5">
                    <div class="mobile-checkout">
                        <div class="row">
                            <div class="col-auto">
                                <div class="mobile-checkout__count">
                                    3 items
                                </div>
                            </div>
                            <div class="col">
                                <div class="mobile-checkout__details">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="mobile-checkout__info">
                                                <div>Subtotal: <strong>$2856.00</strong></div>
                                                <div>Shipping: Free</div>
                                                <div>Total: <strong><span>$2856.00</span></strong></div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#">Edit</a>
                                        </div>
                                    </div>
                                    <div class="position-relative footer__newsleter">
                                        <input type="email" class="footer__newsleter-input"
                                            placeholder="Discount code or gift card">
                                        <button><svg width="18" height="14" viewBox="0 0 18 14" fill="none"
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
                </div>
                <button class="second-button checkout-button mb-5 mb-md-0" v-on:click="save">Pay Now</button>

            </div>
            <div class="col-lg-auto pt-2 d-md-block d-none">
                <BasketSide
                        v-bind:total="total"
                        v-bind:conex="conex"
                        v-on:basketchange="basketchange"
                    />
            </div>
        </div>

    </div>

    <div class="cover" v-if="exchange"></div>
	`
};
