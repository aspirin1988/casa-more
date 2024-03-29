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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/brand.js":
/*!*******************************!*\
  !*** ./resources/js/brand.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

// (function () {
//     var one = document.getElementById('form-h-range-1');
//     var tow = document.getElementById('form-h-range-2');
//     var min_price = document.getElementById('min-price');
//     var max_price = document.getElementById('max-price');
//     var getPos = function (max, min, max_c, min_c) {
//         var delta = max - min;
//         var width = ((max_c - min_c) / delta) * 144;
//         var left = ((min_c - min) / delta) * 144;
//         progress.style.left = left + 'px';
//         progress.style.width = width + 'px';
//     };
//     if(one)
//     one.addEventListener('input', function () {
//         if (parseInt(this.value) > parseInt(tow.value)) {
//             this.value = parseInt(tow.value) - 5;
//             return false;
//         }
//         min_price.value = this.value;
//         // getPos(28000,20000,tow.value,this.value)
//     });
//
//     if(tow)
//     tow.addEventListener('input', function () {
//         if (parseInt(this.value) < parseInt(one.value)) {
//             this.value = parseInt(one.value) + 5;
//             return false;
//         }
//         max_price.value = this.value;
//         // getPos(28000,20000,this.value,one.value)
//     });
//     if(min_price)
//     min_price.addEventListener('input', function () {
//         if (parseInt(this.value) > parseInt(tow.value)) {
//             one.value = this.value = parseInt(tow.value) - 5;
//         } else {
//             one.value = this.value
//         }
//     });
//
//     if(max_price)
//     max_price.addEventListener('input', function () {
//         if (parseInt(this.value) < parseInt(one.value)) {
//             tow.value = this.value = parseInt(one.value) + 5;
//         } else {
//             tow.value = this.value
//         }
//     });
//
//
//     var button = document.querySelector('#show_filter');
//     var price = document.querySelector('.uk-filter-grid .uk-filter-grid-price');
//     var reset = document.querySelector('.uk-filter-grid .uk-filter-grid-reset');
//
//     if(button)
//     button.addEventListener('click',function () {
//         price.classList.toggle('uk-active');
//         reset.classList.toggle('uk-active');
//         price.classList.toggle('uk-animation-scale-up');
//         reset.classList.toggle('uk-animation-scale-up');
//     });
//
// })();

/***/ }),

/***/ 1:
/*!*************************************!*\
  !*** multi ./resources/js/brand.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/sergeydemidov/PhpstormProjects/casa-more/resources/js/brand.js */"./resources/js/brand.js");


/***/ })

/******/ });