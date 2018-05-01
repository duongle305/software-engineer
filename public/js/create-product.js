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
/******/ 	return __webpack_require__(__webpack_require__.s = 35);
/******/ })
/************************************************************************/
/******/ ({

/***/ 35:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(36);


/***/ }),

/***/ 36:
/***/ (function(module, __webpack_exports__) {

"use strict";
var app = new Vue({
    el: '#app',
    data: {
        isAddColor: false,
        isAddSize: false,
        sizeTypeId: '',
        sizes: [],
        colors: []
    },
    methods: {
        getSizes: function getSizes(e) {
            var _this = this;

            var selected = e.target.options[e.target.options.selectedIndex];
            $('select.select-multiple-sizes').empty().trigger('change');
            if (selected !== undefined) {
                axios.get(selected.dataset.href).then(function (rs) {
                    _this.sizes = rs.data;
                    _this.sizes.forEach(function (el) {
                        el.text = el.name;
                    });
                    $('select.select-multiple-sizes').select2({ data: _this.sizes }).trigger('change');
                }).catch(function (e) {});
            }
        },
        getColors: function getColors(e) {
            var _this2 = this;

            $('select.select-multiple-colors').empty().trigger('change');
            if (e.target.dataset.href) {
                axios.get(e.target.dataset.href).then(function (res) {
                    _this2.colors = res.data;
                    _this2.colors.forEach(function (el) {
                        el.text = el.name;
                    });
                    $('select.select-multiple-colors').select2({ data: _this2.colors }).trigger('change');
                    $();
                });
            }
        }
    }
});

/***/ })

/******/ });