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
/******/ 	return __webpack_require__(__webpack_require__.s = 39);
/******/ })
/************************************************************************/
/******/ ({

/***/ 39:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(40);


/***/ }),

/***/ 40:
/***/ (function(module, exports) {

var app = new Vue({
    el: '#app',
    data: {
        editPermission: false,
        permission: {
            id: '',
            name: '',
            display_name: '',
            description: '',
            created_at: ''
        },
        href: {
            edit: '',
            update: '',
            delete: ''
        }
    },
    methods: {
        showEdit: function showEdit(e) {
            if (this.editPermission) this.editPermission = !this.editPermission;
            this.href.edit = e.relatedTarget.dataset.edit;
            this.href.update = e.relatedTarget.dataset.update;
            this.getPermission();
        },
        getPermission: function getPermission() {
            var _this = this;

            axios.get(this.href.edit).then(function (rs) {
                _this.permission = rs.data;
            }).catch(function (error) {});
        },
        updatePermission: function updatePermission() {
            axios.put(this.href.update, this.permission).then(function (rs) {
                location.href = rs.data.href;
            }).catch(function (e) {
                $.toast({
                    heading: 'Thông báo !',
                    text: e.response.data.message,
                    showHideTransition: 'slide',
                    icon: 'error',
                    loaderBg: '#f96868',
                    position: 'top-right'
                });
            });
        },
        deletePermission: function deletePermission() {
            axios.delete(this.href.delete).then(function (rs) {
                if (rs.status === 200) {
                    swal('Đã xóa', '' + rs.data.message, 'success').then(function () {
                        location.reload();
                    });
                }
            }).catch(function (e) {
                if (e.response.status === 403) {
                    swal('Thông báo', '' + e.response.data.message, 'error');
                }
            });
        },
        showMessage: function showMessage(e) {
            var _this2 = this;

            this.href.delete = e.target.dataset.delete;
            swal({
                title: 'B\u1EA1n c\xF3 mu\u1ED1n x\xF3a quy\u1EC1n ' + e.target.dataset.name + '?',
                text: 'Sau khi \u0111\u1ED3ng \xFD b\u1EA1n s\u1EBD kh\xF4ng kh\xF4i ph\u1EE5c l\u1EA1i \u0111\u01B0\u1EE3c.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#fb9678',
                confirmButtonText: 'Đồng ý'
            }).then(function () {
                _this2.deletePermission();
            }).catch(function (e) {});
        }
    },
    mounted: function mounted() {
        var _this3 = this;

        $(this.$refs.vueModal).on('show.bs.modal', function (e) {
            _this3.showEdit(e);
        });
    }
});

/***/ })

/******/ });