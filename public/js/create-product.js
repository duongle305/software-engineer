<<<<<<< HEAD
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
/***/ (function(module, exports) {

var app = new Vue({
    el: '#app',
    data: {
        isAddColor: false,
        isAddSize: false,
        sizeTypeId: '',
        sizes: [],
        colors: [],
        name: ''
    },
    watch: {
        name: function name(str) {
            this.getSlug(str);
        }
    },
    methods: {
        getSizes: function getSizes(e) {
            var _this = this;

            var selected = e.target.options[e.target.options.selectedIndex];
            if (selected !== undefined) {
                axios.get(selected.dataset.href).then(function (rs) {
                    _this.sizes = rs.data;
                    _this.sizes.forEach(function (el) {
                        el.text = el.name;
                    });
                }).catch(function (e) {});
            }
        },
        getColors: function getColors(e) {
            var _this2 = this;

            if (e.target.dataset.href) {
                axios.get(e.target.dataset.href).then(function (res) {
                    _this2.colors = res.data;
                    _this2.colors.forEach(function (el) {
                        el.text = el.name;
                    });
                });
            }
        },

        getSlug: function getSlug(str) {
            return this.generateSlug(str);
        },
        generateSlug: function generateSlug(str) {
            var slug = '';
            slug = str.toLowerCase();
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            slug = slug.replace(/ /gi, "-");
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            return slug;
        }
    }
});

Vue.component('select2-multiple', {
    template: '\n        <select :name="name" multiple style="width: 100%"></select>\n    ',
    props: ['options', 'name'],
    mounted: function mounted() {
        $(this.$el).select2({ data: this.options }).trigger('change');
    },

    watch: {
        options: function options(_options) {
            $(this.$el).select2().empty().trigger('change');
            $(this.$el).select2({ data: _options }).trigger('change');
        }
    }
});

/***/ })

/******/ });
=======
!function(t){var e={};function n(o){if(e[o])return e[o].exports;var r=e[o]={i:o,l:!1,exports:{}};return t[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=t,n.c=e,n.d=function(t,e,o){n.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:o})},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=35)}({35:function(t,e,n){t.exports=n(36)},36:function(t,e){new Vue({el:"#app",data:{isAddColor:!1,isAddSize:!1,sizeTypeId:"",sizes:[],colors:[]},methods:{getSizes:function(t){var e=this,n=t.target.options[t.target.options.selectedIndex];void 0!==n&&axios.get(n.dataset.href).then(function(t){e.sizes=t.data,e.sizes.forEach(function(t){t.text=t.name})}).catch(function(t){})},getColors:function(t){var e=this;t.target.dataset.href&&axios.get(t.target.dataset.href).then(function(t){e.colors=t.data,e.colors.forEach(function(t){t.text=t.name})})}}});Vue.component("select2-multiple",{template:'\n        <select :name="name" multiple style="width: 100%"></select>\n    ',props:["options","name"],mounted:function(){$(this.$el).select2({data:this.options}).trigger("change")},watch:{options:function(t){$(this.$el).select2().empty().trigger("change"),$(this.$el).select2({data:t}).trigger("change")}}})}});
>>>>>>> 5919e289f38f1a33c82f6df3329f971d237d4250
