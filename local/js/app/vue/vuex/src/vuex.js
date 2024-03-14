import {Store} from 'ui.vue3.vuex';
import createMutationsSharer from 'vuex-shared-mutations';
import 'x.vue.loader';

const control = {
    init () { // инициализация
        store.dispatch('init');
    },
}

const storage = {
    
    // сохраняет данные в хранилище
    save (key, data, expire) {
        let storageKey = 'store-'+key;
        let storageKeyExp = 'store-'+key+'-exp';
        
        localStorage.setItem(storageKey,JSON.stringify(data));
        localStorage.setItem(storageKeyExp,parseInt(expire));
    },
    
    // получаем данныех из хранилища
    read (key) {
        let storageKey = 'store-'+key;
        let storageKeyExp = 'store-'+key+'-exp';
        let now = Date.now()/1000;
        
        let data = localStorage.getItem(storageKey); // пытаемся поднять данные из LS
        
        if (data && data.length) { // данные есть
            let exp = localStorage.getItem(storageKeyExp);
            // и не устарели
            //console.log('app.vue.vuex',exp, now);
            if (exp && exp > now) { // проверяем что данные не устарели
                return JSON.parse(data); // отдаем
            }
        }
        return false;
    },
    
    clear (key) {
        let storageKey = 'store-'+key;
        let storageKeyExp = 'store-'+key+'-exp';
        
        localStorage.removeItem(storageKey);
        localStorage.removeItem(storageKeyExp);
    }
    
}

/*
 * некоторые ключи Vuex которые автоматически загружаются во время инициализации хранилича
 * point - точка к которой надо обратиться
 * 
 * params - данные которые надо передать в виде параметров в контроллер
 * expire - если больше 0, данные будут сохранены на клиенте на столько секунд,
 *      т.е. при expire - данные не будут запрашиваться с севера в течении 100 секунд,
 *      а будут считываться из хранилища на клиенте
 *
 * Так же ключи указанные тут можно перезагрузить с сервера по пимени вызвав action reload:
 *      this.$store.dispatch('reload', key); где key - имя ключа который надо перезагрузить
 *
 * Если компонент получает на запрос готовые данные, которые нужно записать в ключ, то следует использовать экшен update
 *      this.$store.dispatch('update',{key:'basket', data:response.data}); - для перезагрузки данных в корзине,
 *      как в компоненте bsket.order
 *      
*/
const shema = {
    // общие данны
    'config': { // TODO: придумать способе коррекции времени
            point: '/api/config',
            params: {}
        }, // некоторые константы битрикс, параметры окружения, и опции проекта
    'basket': {
            point: '/api/basket',
            params: {}
            //expire: 10
        }, // корзины
    'favorites': {
            point: '/api/favorites',
            default: []
        } // список ID избранного
        
};

const store = new Store(
{
    strict: true, //storeData.config?.env?.stage == 'dev',
    debug: true, //storeData.config?.env?.stage == 'dev',
    
    state: {},
    
    actions: {
        
        init ({state,dispatch,commit})
        { // экшен инициализации хранилища
            
            // перебираем данные которые мы должны получать от сервера
            for (let key in shema) {
                let documentsCarrier = document.querySelector('head script[type="extension/settings"][name="'+key+'"]');
                let data;
                if (documentsCarrier) {
                    data = JSON.parse(documentsCarrier.innerText);
                    console.log('app.vue.vuex','данные из носителя в документе',data);
                } else {
                    data = storage.read(key); // пробуем прочитать данные из локального хранилища
                }
                if (!data) {
                    dispatch('reload', key); // и запрашиваем с сервера если их нет
                } else {
                    commit('update',{'key':key, 'data':data}); // ... востаналвиваем если есть
                    console.log('app.vue.vuex','Востановлены данные секции', key);
                }
            }
        },
        
        reload ({dispatch}, key)
        {
            // перегрузка списка ключей
            let now = Date.now()/1000;
            let point = shema[key].point;
            if (point) {
                let data = Object.assign({
                        timestamp: now,
                        sessid: BX.bitrix_sessid()
                    }, shema[key].params);
                


                BX.ajax.post(
                        point,
                        data,
                        (response) => {
                            response = JSON.parse(response);
                            //console.log(response);
                            if (response.status == 'error') {
                                if (this.strict) console.log('app.vue.vuex',response);
                            } else if (response.status == 'success') {
                                if (response.data) {
                                    dispatch('update',{key:key, data:response.data});
                                }
                            }
                        }
                    );
            }
        },
        
        
        update ({commit}, payload)
        {
            let key = payload.key
            let data = payload.data
console.log(payload);
            
            commit('update',{key:key, data:data});
            if (this.strict) console.log('app.vue.vuex','Обновлены данные секции', key, data);


            
            // сохрнаемя данные в локальное хранилище
            if (shema[key].expire) { // ... если данные вообще нужно сохранять на клиенте
                let now = Date.now()/1000;
                let expire = now+shema[key].expire;
                storage.save(key, data, expire);
            }

            
            // выполним onUpdate
            //if (shema[key].onUpdate) {
            //    shema[key].onUpdate(data);
            //}
        }
    },
    
    mutations: {
        /*
         * Все изменения проходящие через эту мутацию (в оснонвм это данные из sheme)
         * отслеживаются плагином шаринга который синхронизирует эти данные между вкладками
         * что позволяет актуализировать корзину, избранное и т.п.
         * не следует использовать эту мутацию для данных которые не должны быть синхронны во всех вкладках
         * т.е. для данных не связанных с пользователем (как избранное или корзина) или сервером (как config),
         * а связанных со страницеей как данные о товаре.
         *
         * Для таких данных нужно использовать мутацию updateLocal
         * 
        */
        update (state,params) {
            state[params.key] = params.data;
        },
        
        /*
         * Мутация загружает ключ в хранилище аналогично update,
         * но не шарит его между вкладками (не отслеживается плагином vuex-shared-mutations)
        */
        updateLocal (state,params) {
            state[params.key] = params.data;
        },
    },
    
    plugins: [createMutationsSharer({ predicate: ['update'] })]
});

store.control = control;
//store.storage = storage;

window.addEventListener('load', ()=>{
        store.control.init();
    });

BX.X.Vue.loader.addStore(store);

export {store};


