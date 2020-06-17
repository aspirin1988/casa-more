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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/single.js":
/*!********************************!*\
  !*** ./resources/js/single.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function () {
  var current_price = 0;
  var current_product = 0;
  var current_count = 1;
  var button_submit = document.querySelector('#submit');
  var not_available = document.querySelector('#not_available');
  var input_count = document.querySelector('#count');
  if (button_submit) button_submit.addEventListener('click', function () {
    var product_ = {};

    for (var i = 0; i < prices.length; i++) {
      var item = prices[i];

      if (item.checked) {
        product_ = item;
      }
    }

    current_product = product_.dataset['id'];
    current_price = product_.dataset['price'];
    var product = {
      id: current_product,
      price: current_price,
      count: current_count
    };
    var basket = JSON.parse(localStorage.getItem('basket'));
    var concat = false;

    if (basket) {
      for (var _i = 0; _i < basket.length; _i++) {
        if (basket[_i].id === product.id) {
          basket[_i].count = parseInt(basket[_i].count) + parseInt(product.count);
          concat = true;
        }
      }

      if (!concat) {
        basket.push(product);
      }

      localStorage.setItem('basket', JSON.stringify(basket));
      UIkit.notification({
        message: 'Товар успешно добавлен в корзину!',
        status: 'success'
      });
    } else {
      basket = [];
      basket.push(product);
      localStorage.setItem('basket', JSON.stringify(basket));
      UIkit.notification({
        message: 'Товар успешно добавлен в корзину!',
        status: 'success'
      });
    }

    input_count.value = 1;
  });
  if (input_count) input_count.addEventListener('change', function () {
    current_count = parseInt(this.value);

    if (!this.value) {
      this.value = 1;
    }
  });
  var img_container = document.querySelector('.uk-product-img');
  var img_paralag_before = document.querySelector('.uk-product-img .uk-product-parallax-before');
  var img_paralag_after = document.querySelector('.uk-product-img .uk-product-parallax-after');
  if (img_paralag_after) img_paralag_after.addEventListener('mousemove', function (e) {
    var height = img_paralag_after.clientHeight;
    var width = img_paralag_after.clientWidth;
    var y = (height / e.clientY - height / e.clientY / 2) * 10;
    var x = (width / e.clientX - width / e.clientX / 2) * 10;

    if (Math.abs(y) > 50) {
      y = 50 * Math.sign(y);
    }

    if (Math.abs(x) > 50) {
      x = 50 * Math.sign(x);
    }

    img_paralag_before.style.transform = 'translate(' + x + 'px,' + y + 'px)';
    img_paralag_after.style.transform = 'translate(' + x * -1 + 'px,' + y * -1 + 'px)';
  });

  select_ = function select_(i, key) {
    var result = {};
    var pr_data = i.getAttribute('product-data');
    var arr = pr_data.split(',');
    arr.forEach(function (i) {
      var values = i.split(':');
      result[values[0]] = values[1];
    });
    container.innerText = i.dataset['price'];
    if (flower && result.thumb_flower) flower.src = result.thumb_flower.toString();
    if (bottle && result.thumb_bottle) bottle.src = result.thumb_bottle.toString();
    if (box && result.thumb_box) box.src = result.thumb_box.toString();

    if (result.not_available) {
      button_submit.style.display = 'none';
      input_count.style.display = 'none';
      not_available.style.display = 'block';
    } else {
      button_submit.style.display = 'block';
      input_count.style.display = 'block';
      not_available.style.display = 'none';
    }

    UIkit.switcher(document.querySelector('.my-switcher-container')).show(key);
    container.innerText = result.price;
  };

  var tags = document.querySelector('.switcher-container');
  var prices = document.querySelectorAll('input[data-price]');
  var flower = document.querySelector('img#flower');
  var bottle = document.querySelector('img#bottle');
  var box = document.querySelector('img#box');
  var container = document.querySelector('[data-insert-price]');
  prices.forEach(function (i, key) {
    i.addEventListener('click', function () {
      select_(i, key);
    });
  });

  if (tags) {
    prices.forEach(function (i, key) {
      if (i.checked) {
        select_(i, key);
      }
    });
  }
})();

/***/ }),

/***/ 2:
/*!**************************************!*\
  !*** multi ./resources/js/single.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/sergeydemidov/PhpstormProjects/casa-more/resources/js/single.js */"./resources/js/single.js");


/***/ })

/******/ });