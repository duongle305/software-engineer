/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 37);
/******/ })
/************************************************************************/
/******/ ({

/***/ 37:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(38);


/***/ }),

/***/ 38:
/***/ (function(module, exports) {

var app = new Vue({
    el: '#app',
    data: {
        tab: 'PENDING',
        hrefData: '',
        pagination: {},
        result: [],
        url: 'orders/',
        search: '',
        dataSearch: []
    },
    methods: {
        getDataOrders: function getDataOrders(tab) {
            var _this = this;

            var page = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;

            $('div.loader').show();
            this.tab = tab;
            axios.get(this.hrefData + '/' + tab + '?page=' + page).then(function (res) {
                _this.result = res.data.data;
                _this.pagination = res.data;
                var time = setTimeout(function () {
                    $('div.loader').fadeOut();
                    clearTimeout(time);
                }, 500);
            });
        },
        formatNumber: function formatNumber(num) {
            return $.number(num);
        },
        changeStatus: function changeStatus(status, id) {
            return axios.post('status-orders/' + id, {
                status: status
            });
        },
        readyToShip: function readyToShip(index) {
            var _this2 = this;

            if (this.result[index]) {
                this.changeStatus('READY', this.result[index].id).then(function (res) {
                    _this2.result.splice(index, 1);
                    swal('Thành công', '', 'success').then(function () {});
                });
            }
        },
        shipped: function shipped(index) {
            var _this3 = this;

            if (this.result[index]) {
                this.changeStatus('SHIPPED', this.result[index].id).then(function (res) {
                    _this3.result.splice(index, 1);
                    swal('Thành công', '', 'success').then(function () {});
                });
            }
        },
        delivered: function delivered(index) {
            var _this4 = this;

            if (this.result[index]) {
                this.changeStatus('DELIVERED', this.result[index].id).then(function (res) {
                    _this4.result.splice(index, 1);
                    swal('Thành công', '', 'success').then(function () {});
                });
            }
        },
        returned: function returned(index) {
            var _this5 = this;

            if (this.result[index]) {
                this.changeStatus('RETURNED', this.result[index].id).then(function (res) {
                    _this5.result.splice(index, 1);
                    swal('Thành công', '', 'success').then(function () {});
                });
            }
        },
        deliveryFailed: function deliveryFailed(index) {
            var _this6 = this;

            if (this.result[index]) {
                this.changeStatus('DELIVERY FAILED', this.result[index].id).then(function (res) {
                    _this6.result.splice(index, 1);
                    swal('Thành công', '', 'success').then(function () {});
                });
            }
        },
        cancelled: function cancelled(index) {
            var _this7 = this;

            swal({
                title: 'B\u1EA1n c\xF3 mu\u1ED1n h\u1EE7y b\u1ECF \u0111\u01A1n h\xE0ng ' + this.result[index].code + '?',
                text: "Sau khi đồng ý bạn sẽ không khôi phục lại được.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#fb9678',
                confirmButtonText: 'Đồng ý'
            }).then(function () {
                if (_this7.result[index]) {
                    _this7.changeStatus('CANCELLED', _this7.result[index].id).then(function (res) {
                        _this7.result.splice(index, 1);
                    });
                }
            }).catch(function (e) {});
        },
        findOrder: function findOrder(val) {
            var _this8 = this;

            axios.get('/admin-dl/search-orders/' + this.tab + '/' + val).then(function (res) {
                _this8.result = res.data.data;
                _this8.pagination = res.data;
            });
        }
    },
    mounted: function mounted() {
        this.hrefData = $('#href-data').val();
        this.getDataOrders(this.tab);
    },

    watch: {
        search: function search(val) {
            return this.findOrder(val);
        }
    }
});

/***/ })

/******/ });