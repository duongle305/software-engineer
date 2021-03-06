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
/******/ 	return __webpack_require__(__webpack_require__.s = 43);
/******/ })
/************************************************************************/
/******/ ({

/***/ 43:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(44);


/***/ }),

/***/ 44:
/***/ (function(module, exports) {

var app = new Vue({
    el: '#app',
    data: {
        delete: '',
        hrefData: '',
        result: [],
        search: '',
        pagination: []
    },
    methods: {
        showDelete: function showDelete(e, index) {
            var _this = this;

            this.delete = e.target.dataset.delete;
            swal({
                title: 'B\u1EA1n c\xF3 mu\u1ED1n x\xF3a s\u1EA3n ph\u1EA9m ' + this.result[index].title + '?',
                text: "Sau khi đồng ý bạn sẽ không khôi phục lại được.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#fb9678',
                confirmButtonText: 'Đồng ý'
            }).then(function () {
                _this.deleteProduct();
            }).catch(function (e) {});
        },
        getAllProducts: function getAllProducts() {
            var _this2 = this;

            var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;

            $('div.loader').show();
            axios.get(this.hrefData + '?page=' + page).then(function (res) {
                _this2.result = res.data.data;
                _this2.pagination = res.data;
                var time = setTimeout(function () {
                    $('div.loader').fadeOut();
                    clearTimeout(time);
                }, 500);
            });
        },
        deleteProduct: function deleteProduct(index) {
            var _this3 = this;

            this.result.splice(index, 1);
            axios.delete(this.delete).then(function (rs) {
                _this3.result.splice(index, 1);
                swal('Đã xóa!', '' + rs.data.message, 'success');
            }).catch(function (e) {
                swal('Thông báo!', '' + e.response.data.message, 'error');
            });
        },
        changeStatus: function changeStatus(id, status, index) {
            var _this4 = this;

            event.preventDefault();
            axios.post('status-product/' + id + '/' + status).then(function (res) {
                if (res.status === 200) {
                    swal('Thành công!', '' + res.data.message, 'success');
                    _this4.result[index].status = status;
                }
            }).catch(function (err) {
                swal('Kh\xF4ng t\xECm th\u1EA5y s\u1EA3n ph\u1EA9m!');
            });
        },
        formatDate: function formatDate(str) {
            var date = new Date(str);
            return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
        },
        searchProduct: function searchProduct(val) {
            var _this5 = this;

            if (val) {
                axios.get('search-products/' + val).then(function (res) {
                    _this5.pagination = res.data;
                    _this5.result = res.data.data;
                }).catch(function (err) {});
            } else {
                axios.get('' + this.hrefData).then(function (res) {
                    _this5.result = res.data.data;
                    _this5.pagination = res.data;
                });
            }
        }
    },
    mounted: function mounted() {
        this.hrefData = $('#href-data').val();
        this.getAllProducts();
    },

    watch: {
        search: function search(val) {
            return this.searchProduct(val);
        }
    }
});

/***/ })

/******/ });