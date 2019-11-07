(function () {
    let current_price = 0;
    let current_product = 0;
    let current_count = 1;

    let button_submit = document.querySelector('#submit');
    let not_available = document.querySelector('#not_available');
    let input_count = document.querySelector('#count');

    if (button_submit)
        button_submit.addEventListener('click', function () {

            let product_ = {};
            for (let i = 0; i < prices.length; i++) {
                let item = prices[i];
                if (item.checked) {
                    product_ = item;
                }
            }
            current_product = product_.dataset['id'];
            current_price = product_.dataset['price'];

            let product = {id: current_product, price: current_price, count: current_count};
            let basket = JSON.parse(localStorage.getItem('basket'));
            let concat = false;
            if (basket) {
                for (let i = 0; i < basket.length; i++) {
                    if (basket[i].id === product.id) {
                        basket[i].count = parseInt(basket[i].count) + parseInt(product.count);
                        concat = true;
                    }
                }
                if (!concat) {
                    basket.push(product);
                }
                localStorage.setItem('basket', JSON.stringify(basket));
                UIkit.notification({message: 'Товар успешно добавлен в корзину!', status: 'success'});
            } else {
                basket = [];
                basket.push(product);
                localStorage.setItem('basket', JSON.stringify(basket));
                UIkit.notification({message: 'Товар успешно добавлен в корзину!', status: 'success'});
            }
            input_count.value = 1;
        });

    if (input_count)
        input_count.addEventListener('change', function () {
            current_count = parseInt(this.value);
            if (!this.value) {
                this.value = 1;
            }
        });

    var img_container = document.querySelector('.uk-product-img');
    var img_paralag_before = document.querySelector('.uk-product-img .uk-product-parallax-before');
    var img_paralag_after = document.querySelector('.uk-product-img .uk-product-parallax-after');
    if (img_paralag_after)
        img_paralag_after.addEventListener('mousemove', function (e) {
            var height = img_paralag_after.clientHeight;
            var width = img_paralag_after.clientWidth;
            var y = ((height / e.clientY) - ((height / e.clientY) / 2)) * 10;
            var x = ((width / e.clientX) - ((width / e.clientX) / 2)) * 10;

            if (Math.abs(y) > 50) {
                y = 50 * Math.sign(y);
            }

            if (Math.abs(x) > 50) {
                x = 50 * Math.sign(x);
            }

            img_paralag_before.style.transform = 'translate(' + x + 'px,' + y + 'px)';
            img_paralag_after.style.transform = 'translate(' + x * -1 + 'px,' + y * -1 + 'px)';
        });

    select_ = function (i, key) {
        let result = {};
        let pr_data = i.getAttribute('product-data');
        let arr = pr_data.split(',');
        arr.forEach(function (i) {
            let values = i.split(':');
            result[values[0]] = values[1];
        });
        container.innerText = i.dataset['price'];
        if (flower && result.thumb_flower)
            flower.src = result.thumb_flower.toString();

        if (bottle && result.thumb_bottle)
            bottle.src = result.thumb_bottle.toString();

        if (box && result.thumb_box)
            box.src = result.thumb_box.toString();

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
        container.innerText = result.price
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
        })
    });
    if (tags) {
        prices.forEach(function (i, key) {
            if (i.checked) {
                select_(i, key)
            }
        });
    }
})();
