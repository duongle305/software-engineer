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
/******/ 	return __webpack_require__(__webpack_require__.s = 69);
/******/ })
/************************************************************************/
/******/ ({

/***/ 69:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(70);


/***/ }),

/***/ 70:
/***/ (function(module, exports) {

var title = $('.breadcrumb .active > span').attr('id');
var app = new Vue({
    el: '#app',
    data: {
        isChangeAddress: parseInt($('#oldChange').val()),
        isSelectedWard: false,
        isSelectedProvince: false,
        isSelectedDistrict: false,
        detail: '',
        provinces: [],
        districts: [],
        wards: [],
        address: '',
        title: title
    },
    methods: {
        getProvinces: function getProvinces() {
            var _this = this;

            axios.get('/admin-dl/ajax/provinces').then(function (rs) {
                _this.provinces = rs.data;
            }).catch(function (e) {});
        },
        getDistricts: function getDistricts(e) {
            var _this2 = this;

            var selected = e.target.options[e.target.options.selectedIndex];
            if (selected !== undefined) {
                var province_id = selected.dataset.id;
                axios.get('/admin-dl/ajax/districts/' + province_id).then(function (rs) {
                    _this2.districts = rs.data;
                }).catch(function (e) {});
            }
        },
        getWards: function getWards(e) {
            var _this3 = this;

            var selected = e.target.options[e.target.options.selectedIndex];
            if (selected !== undefined) {
                var district_id = selected.dataset.id;
                axios.get('/admin-dl/ajax/wards/' + district_id).then(function (rs) {
                    _this3.wards = rs.data;
                }).catch(function (e) {});
            }
        },
        reset: function reset() {
            this.isSelectedWard = undefined;
            this.isSelectedDistrict = undefined;
            this.isSelectedProvince = undefined;
            this.detail = null;
        },

        getSlug: function getSlug(str) {
            return this.generateSlug(str);
        },
        generateSlug: function generateSlug(str) {
            return strslug(str);
        }
    },
    mounted: function mounted() {
        this.getProvinces();
    }
});

/***/ })

/******/ });