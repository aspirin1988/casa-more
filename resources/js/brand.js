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