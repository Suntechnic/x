/* eslint-disable */
this.BX = this.BX || {};
this.BX.App = this.BX.App || {};
(function (exports,ui_vue3_vuex) {
	'use strict';

	function unwrapExports(x) {
	  return x && x.__esModule && Object.prototype.hasOwnProperty.call(x, 'default') ? x["default"] : x;
	}
	function createCommonjsModule(fn, module) {
	  return module = {
	    exports: {}
	  }, fn(module, module.exports), module.exports;
	}

	var vuexSharedMutations = createCommonjsModule(function (module, exports) {
	!function (e, t) {
	  "object" == (babelHelpers["typeof"](exports)) && "object" == (babelHelpers["typeof"](module)) ? module.exports = t() : "object" == (babelHelpers["typeof"](exports)) ? exports.vuexSharedMutations = t() : e.vuexSharedMutations = t();
	}(window, function () {
	  return function (e) {
	    var t = {};
	    function n(r) {
	      if (t[r]) return t[r].exports;
	      var o = t[r] = {
	        i: r,
	        l: !1,
	        exports: {}
	      };
	      return e[r].call(o.exports, o, o.exports, n), o.l = !0, o.exports;
	    }
	    return n.m = e, n.c = t, n.d = function (e, t, r) {
	      n.o(e, t) || Object.defineProperty(e, t, {
	        enumerable: !0,
	        get: r
	      });
	    }, n.r = function (e) {
	      "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
	        value: "Module"
	      }), Object.defineProperty(e, "__esModule", {
	        value: !0
	      });
	    }, n.t = function (e, t) {
	      if (1 & t && (e = n(e)), 8 & t) return e;
	      if (4 & t && "object" == babelHelpers["typeof"](e) && e && e.__esModule) return e;
	      var r = Object.create(null);
	      if (n.r(r), Object.defineProperty(r, "default", {
	        enumerable: !0,
	        value: e
	      }), 2 & t && "string" != typeof e) for (var o in e) n.d(r, o, function (t) {
	        return e[t];
	      }.bind(null, o));
	      return r;
	    }, n.n = function (e) {
	      var t = e && e.__esModule ? function () {
	        return e["default"];
	      } : function () {
	        return e;
	      };
	      return n.d(t, "a", t), t;
	    }, n.o = function (e, t) {
	      return Object.prototype.hasOwnProperty.call(e, t);
	    }, n.p = "", n(n.s = 3);
	  }([function (e, t, n) {

	    (function (e) {
	      function r(e, t) {
	        for (var n = 0; n < t.length; n++) {
	          var r = t[n];
	          r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r);
	        }
	      }
	      function o(e, t, n) {
	        return t && r(e.prototype, t), n && r(e, n), e;
	      }
	      n.d(t, "a", function () {
	        return u;
	      });
	      var a = "vuex-shared-mutations",
	        i = "undefined" != typeof window ? window : e,
	        u = function () {
	          function e() {
	            var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
	            !function (e, t) {
	              if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function");
	            }(this, e);
	            var n = t.BroadcastChannel || i.BroadcastChannel,
	              r = t.key || a;
	            if (!this.constructor.available(n)) throw new Error("Broadcast strategy not available");
	            this.channel = new n(r);
	          }
	          return o(e, null, [{
	            key: "available",
	            value: function value() {
	              return !("function" != typeof (arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : i.BroadcastChannel));
	            }
	          }]), o(e, [{
	            key: "addEventListener",
	            value: function value(e) {
	              this.channel.addEventListener("message", function (t) {
	                e(t.data);
	              });
	            }
	          }, {
	            key: "share",
	            value: function value(e) {
	              return this.channel.postMessage(e);
	            }
	          }]), e;
	        }();
	    }).call(this, n(2));
	  }, function (e, t, n) {

	    (function (e) {
	      function r(e, t, n) {
	        return t in e ? Object.defineProperty(e, t, {
	          value: n,
	          enumerable: !0,
	          configurable: !0,
	          writable: !0
	        }) : e[t] = n, e;
	      }
	      function o(e, t) {
	        for (var n = 0; n < t.length; n++) {
	          var r = t[n];
	          r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r);
	        }
	      }
	      function a(e, t, n) {
	        return t && o(e.prototype, t), n && o(e, n), e;
	      }
	      n.d(t, "a", function () {
	        return s;
	      });
	      var i = "vuex-shared-mutations",
	        u = "undefined" != typeof window ? window : e,
	        c = 4096,
	        f = 1;
	      var s = function () {
	        function e() {
	          var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
	          !function (e, t) {
	            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function");
	          }(this, e);
	          var n = t.window || u.window,
	            o = t.localStorage || u.localStorage;
	          if (!this.constructor.available({
	            window: n,
	            localStorage: o
	          })) throw new Error("Strategy unavailable");
	          this.uniqueId = "".concat(Date.now(), "-").concat(Math.random()), this.messageBuffer = [], this.window = n, this.storage = o, this.options = function (e) {
	            for (var t = 1; t < arguments.length; t++) {
	              var n = null != arguments[t] ? arguments[t] : {},
	                o = Object.keys(n);
	              "function" == typeof Object.getOwnPropertySymbols && (o = o.concat(Object.getOwnPropertySymbols(n).filter(function (e) {
	                return Object.getOwnPropertyDescriptor(n, e).enumerable;
	              }))), o.forEach(function (t) {
	                r(e, t, n[t]);
	              });
	            }
	            return e;
	          }({
	            key: i
	          }, t);
	        }
	        return a(e, null, [{
	          key: "available",
	          value: function value() {
	            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {
	                window: u.window,
	                localStorage: u.localStorage
	              },
	              t = e.window,
	              n = e.localStorage;
	            if (!t || !n) return !1;
	            try {
	              return n.setItem("vuex-shared-mutations-test-key", Date.now()), n.removeItem("vuex-shared-mutations-test-key"), !0;
	            } catch (e) {
	              return !1;
	            }
	          }
	        }]), a(e, [{
	          key: "addEventListener",
	          value: function value(e) {
	            var t = this;
	            return this.window.addEventListener("storage", function (n) {
	              if (!n.newValue) return !1;
	              if (-1 === n.key.indexOf("##") || n.key.split("##")[0] !== t.options.key) return !1;
	              var r = t.window.JSON.parse(n.newValue);
	              if (r.author === t.uniqueId) return !1;
	              if (t.messageBuffer.push(r.messagePart), t.messageBuffer.length === r.total) {
	                var o = t.window.JSON.parse(t.messageBuffer.join(""));
	                t.messageBuffer = [], e(o);
	              }
	              return !0;
	            });
	          }
	        }, {
	          key: "share",
	          value: function value(e) {
	            var t = this,
	              n = function (e) {
	                var t = Math.ceil(e.length / c);
	                return Array.from({
	                  length: t
	                }).map(function (t, n) {
	                  return e.substr(n * c, c);
	                });
	              }(this.window.JSON.stringify(e));
	            n.forEach(function (e, r) {
	              f += 1;
	              var o = "".concat(t.options.key, "##").concat(r);
	              t.storage.setItem(o, JSON.stringify({
	                author: t.uniqueId,
	                part: r,
	                total: n.length,
	                messagePart: e,
	                messageCounter: f
	              })), t.storage.removeItem(o);
	            });
	          }
	        }]), e;
	      }();
	    }).call(this, n(2));
	  }, function (e, t) {
	    var n;
	    n = function () {
	      return this;
	    }();
	    try {
	      n = n || new Function("return this")();
	    } catch (e) {
	      "object" == (typeof window === "undefined" ? "undefined" : babelHelpers["typeof"](window)) && (n = window);
	    }
	    e.exports = n;
	  }, function (e, t, n) {

	    n.r(t);
	    var r = n(0),
	      o = n(1);
	    function a(e, t) {
	      if (null == e) return {};
	      var n,
	        r,
	        o = function (e, t) {
	          if (null == e) return {};
	          var n,
	            r,
	            o = {},
	            a = Object.keys(e);
	          for (r = 0; r < a.length; r++) n = a[r], t.indexOf(n) >= 0 || (o[n] = e[n]);
	          return o;
	        }(e, t);
	      if (Object.getOwnPropertySymbols) {
	        var a = Object.getOwnPropertySymbols(e);
	        for (r = 0; r < a.length; r++) n = a[r], t.indexOf(n) >= 0 || Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]);
	      }
	      return o;
	    }
	    n.d(t, "BroadcastChannelStrategy", function () {
	      return r.a;
	    }), n.d(t, "LocalStorageStratery", function () {
	      return o.a;
	    });
	    t["default"] = function () {
	      var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
	        t = e.predicate,
	        n = e.strategy,
	        i = a(e, ["predicate", "strategy"]);
	      if (("storageKey" in i || "sharingKey" in i) && window.console.warn("Configuration directly on plugin was removed, configure specific strategies if needed"), !Array.isArray(t) && "function" != typeof t) throw new Error("Either array of accepted mutations or predicate function must be supplied");
	      var u = "function" == typeof t ? t : function (e) {
	          var n = e.type;
	          return -1 !== t.indexOf(n);
	        },
	        c = !1,
	        f = n || function () {
	          if (o.a.available()) return new o.a();
	          if (r.a.available()) return new r.a();
	          throw new Error("No strategies available");
	        }();
	      return function (e) {
	        e.subscribe(function (e, t) {
	          return c ? Promise.resolve(!1) : Promise.resolve(u(e, t)).then(function (t) {
	            t && f.share(e);
	          });
	        }), f.addEventListener(function (t) {
	          try {
	            c = !0, e.commit(t.type, t.payload);
	          } finally {
	            c = !1;
	          }
	          return "done";
	        });
	      };
	    };
	  }]);
	});
	});

	var createMutationsSharer = unwrapExports(vuexSharedMutations);
	var vuexSharedMutations_1 = vuexSharedMutations.vuexSharedMutations;

	var control = {
	  init: function init() {
	    // инициализация
	    store.dispatch('init');
	  }
	};
	var storage = {
	  // сохраняет данные в хранилище
	  save: function save(key, data, expire) {
	    var storageKey = 'store-' + key;
	    var storageKeyExp = 'store-' + key + '-exp';
	    localStorage.setItem(storageKey, JSON.stringify(data));
	    localStorage.setItem(storageKeyExp, parseInt(expire));
	  },
	  // получаем данныех из хранилища
	  read: function read(key) {
	    var storageKey = 'store-' + key;
	    var storageKeyExp = 'store-' + key + '-exp';
	    var now = Date.now() / 1000;
	    var data = localStorage.getItem(storageKey); // пытаемся поднять данные из LS

	    if (data && data.length) {
	      // данные есть
	      var exp = localStorage.getItem(storageKeyExp);
	      // и не устарели
	      //console.log('app.vue.vuex',exp, now);
	      if (exp && exp > now) {
	        // проверяем что данные не устарели
	        return JSON.parse(data); // отдаем
	      }
	    }
	    return false;
	  },
	  clear: function clear(key) {
	    var storageKey = 'store-' + key;
	    var storageKeyExp = 'store-' + key + '-exp';
	    localStorage.removeItem(storageKey);
	    localStorage.removeItem(storageKeyExp);
	  }
	};

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
	var shema = {
	  // общие данны
	  'config': {
	    // TODO: придумать способе коррекции времени
	    point: '/api/config',
	    params: {}
	  },
	  // некоторые константы битрикс, параметры окружения, и опции проекта
	  'basket': {
	    point: '/api/basket',
	    params: {}
	    //expire: 10
	  },
	  // корзины
	  'favorites': {
	    point: '/api/favorites',
	    "default": []
	  } // список ID избранного
	};
	var store = new ui_vue3_vuex.Store({
	  strict: true,
	  //storeData.config?.env?.stage == 'dev',
	  debug: true,
	  //storeData.config?.env?.stage == 'dev',

	  state: {},
	  actions: {
	    init: function init(_ref) {
	      var state = _ref.state,
	        dispatch = _ref.dispatch,
	        commit = _ref.commit;
	      // экшен инициализации хранилища

	      // перебираем данные которые мы должны получать от сервера
	      for (var key in shema) {
	        var documentsCarrier = document.querySelector('head script[type="extension/settings"][name="' + key + '"]');
	        var data = void 0;
	        if (documentsCarrier) {
	          data = JSON.parse(documentsCarrier.innerText);
	          console.log('app.vue.vuex', 'данные из носителя в документе', data);
	        } else {
	          data = storage.read(key); // пробуем прочитать данные из локального хранилища
	        }
	        if (!data) {
	          dispatch('reload', key); // и запрашиваем с сервера если их нет
	        } else {
	          commit('update', {
	            'key': key,
	            'data': data
	          }); // ... востаналвиваем если есть
	          console.log('app.vue.vuex', 'Востановлены данные секции', key);
	        }
	      }
	    },
	    reload: function reload(_ref2, key) {
	      var _this = this;
	      var dispatch = _ref2.dispatch;
	      // перегрузка списка ключей
	      var now = Date.now() / 1000;
	      var point = shema[key].point;
	      if (point) {
	        var data = Object.assign({
	          timestamp: now,
	          sessid: BX.bitrix_sessid()
	        }, shema[key].params);
	        BX.ajax.post(point, data, function (response) {
	          response = JSON.parse(response);
	          //console.log(response);
	          if (response.status == 'error') {
	            if (_this.strict) console.log('app.vue.vuex', response);
	          } else if (response.status == 'success') {
	            if (response.data) {
	              dispatch('update', {
	                key: key,
	                data: response.data
	              });
	            }
	          }
	        });
	      }
	    },
	    update: function update(_ref3, payload) {
	      var commit = _ref3.commit;
	      var key = payload.key;
	      var data = payload.data;
	      console.log(payload);
	      commit('update', {
	        key: key,
	        data: data
	      });
	      if (this.strict) console.log('app.vue.vuex', 'Обновлены данные секции', key, data);

	      // сохрнаемя данные в локальное хранилище
	      if (shema[key].expire) {
	        // ... если данные вообще нужно сохранять на клиенте
	        var now = Date.now() / 1000;
	        var expire = now + shema[key].expire;
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
	    update: function update(state, params) {
	      state[params.key] = params.data;
	    },
	    /*
	     * Мутация загружает ключ в хранилище аналогично update,
	     * но не шарит его между вкладками (не отслеживается плагином vuex-shared-mutations)
	    */
	    updateLocal: function updateLocal(state, params) {
	      state[params.key] = params.data;
	    }
	  },
	  plugins: [createMutationsSharer({
	    predicate: ['update']
	  })]
	});
	store.control = control;
	//store.storage = storage;

	window.addEventListener('load', function () {
	  store.control.init();
	});
	BX.X.Vue.loader.addStore(store);

	exports.store = store;

}((this.BX.App.Vue = this.BX.App.Vue || {}),BX.Vue3.Vuex));
//# sourceMappingURL=s.js.map
