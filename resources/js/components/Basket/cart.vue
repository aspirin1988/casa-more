<template>
    <div>
        <div class="FormIn">
            <div class="container">
                <div class="FormInWr container sixteen columns">
                    <h1>Корзина</h1>
                    <div class="CartCount" v-if="!count"><span>Корзина пуста</span></div>
                    <div class="CartCount" v-if="count"><span>Количество товаров: <b>{{count}}</b></span></div>
                    <div class="CartCardWr" v-if="count">
                        <div v-for="(item, key ) in list" class="CartCard">
                            <div class="CartCardImg">
                                <img :src="item.image">
                            </div>
                            <h3>{{item.name}}</h3>
                            <div class="CartCardCount">
                                <input type="number" name="count" value="1" v-model="item.count"
                                       @keypress="updateList()" @change="updateList()">
                                <span @click="Plus(key)" class="plus">▲</span>
                                <span @click="Minus(key)" class="minus">▼</span>
                            </div>
                            <span class="CartCardPrice">{{item.price}} <small>тг</small></span>
                            <div class="CartCardRemove">
                                <button class="CartCardRemoveBtn" @click="Delete(key)" type="submit">×</button>
                            </div>
                        </div>
                    </div>
                    <div class="CartCardPriceAll" v-if="count">
                        <span>Стоимость:</span>
                        <div class="CartCardPriceAllR">
                            <b>{{summary}} тг</b>
                            <div class="ProdPostGift" v-if="list_present.length">
                                <i class="item-gift">
                                    <img src="/img/Layer_2_copy.png">
                                </i>
                                <span>подарок</span>
                            </div>
                        </div>
                    </div>
                    <ul class="presents">
                    <li v-for="item in list_present" ><span>{{item}}</span></li>
                    </ul>

                </div>
            </div>
        </div>

        <div class="FormIn">
            <div class="container">
                <div class="FormInWr container sixteen columns">
                    <h2>Личные данные</h2>
                    <div class="form">
                        <div class="tab-active">
                            <label>
                                <span>Имя:</span>
                                <input type="text" v-model="name_" class="text">
                            </label>
                            <label>
                                <span>E-mail:</span>
                                <input type="email" v-model="email" class="text">
                            </label>
                            <label>
                                <span>Телефон:</span>
                                <input type="tel" v-mask="'+###########'" v-model="phone" class="text">
                            </label>
                        </div>
                        <h2>Способ доставки</h2>
                        <div class="FormInTop">
                            <span @click="TabSelect(false)" :class="{'active':!delivery}"
                                  class="FormInTopBtn tab">Самовывоз</span>
                            <span @click="TabSelect(true)" :class="{'active':delivery}"
                                  class="FormInTopBtn tab">Курьером</span>
                        </div>
                        <div id="form-1" :class="{'active':!delivery}" class="tab-form"></div>
                        <div id="form-2" :class="{'active':delivery}" class="tab-form">
                            <label>
                                <span>Город:</span>
                                <input type="text" v-model="city" class="text">
                            </label>
                            <label>
                                <span>Улица:</span>
                                <input type="text" v-model="street" class="text">
                            </label>
                            <label>
                                <span>Дом:</span>
                                <input type="text" v-model="home" class="text">
                            </label>
                            <label>
                                <span>Квартира:</span>
                                <input type="text" v-model="flat" class="text">
                            </label>
                        </div>
                        <div class="CartBottomText">
                            <p>Делать покупки с доставкой — это удобно! Оформите доставку курьером, и мы привезём товар
                                к Вам домой, согласовав дату и время. Доставка осуществляется на следующий день с
                                момента оформления заказа. Наши сотрудники сделают предупредительный звонок за час до
                                доставки. Курьер продемонстрируют целостность и комплектность товара. Внимательно
                                осмотрите товар и проверьте комплектацию: Ваша подпись свидетельствует об отсутствии
                                претензий.</p>

                            <p>При покупке товара, стоимостью cвыше 15 000 тенге, доставка осуществляется бесплатно (в
                                пределах административных границ города).<br>При покупке товара, стоимостью ниже 15 000
                                тенге либо при покупке в розничном магазине, доставка стоит 500 тенге.</p>

                            <p>Подробнее об условиях доставки Вы можете прочитать <a href="#">здесь</a>.</p>
                        </div>

                        <div class="CartCardFinalPrice">
                            <span>Итого:</span> <b>{{summary}} тг</b>
                        </div>
                        <button @click="sendOrder" class="FormInBtn">Перейти к оплате</button>
                        <label class="checkbox-form" style="position: relative; padding-left: 27px; margin-top: 20px; margin-left: auto; margin-right: auto; display: flex; flex-direction: row; font-size: 10px; overflow: hidden; align-items: flex-start; padding-right: 0; letter-spacing: 0.5px; cursor: pointer;     margin-bottom: 80px;">
                            <input type="checkbox" v-model="consent">Соглашаюсь с условиями <a target="_blank" href="/img/оферта.pdf"> договора
                            оферты</a>
                            <b></b>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                count: 0,
                empty: true,
                list: [],
                list_present: [],
                summary: 0,
                email: null,
                name_: null,
                phone: null,
                order: null,
                address_almaty: null,
                city: null,
                address_city: null,
                order_data: {},
                total_amount: 0,
                delivery: false,
                consent: false,
                street: '',
                home: '',
                flat: '',
            }
        },
        mounted() {
            this.getData();
            // this.email = document.getElementById('email');
            // if (localStorage.getItem('email')) {
            //     this.email.value = localStorage.getItem('email');
            // }
            // if (this.email) {
            //     this.email.addEventListener('change', () => {
            //         localStorage.setItem('email', this.email.value);
            //     })
            // }
            //
            // this.name = document.getElementById('name');
            // if (localStorage.getItem('name')) {
            //     this.name.value = localStorage.getItem('name');
            // }
            // if (this.name) {
            //     this.name.addEventListener('change', () => {
            //         localStorage.setItem('name', this.name.value);
            //     })
            // }
            //
            // this.phone = document.getElementById('phone');
            // if (localStorage.getItem('phone')) {
            //     this.phone.value = localStorage.getItem('phone');
            // }
            // if (this.phone) {
            //     this.phone.addEventListener('change', () => {
            //         localStorage.setItem('phone', this.phone.value);
            //     })
            // }
            // this.address_almaty = document.getElementById('address_almaty');
            // if (localStorage.getItem('address_almaty')) {
            //     this.address_almaty.value = localStorage.getItem('address_almaty');
            // }
            // if (this.address_almaty) {
            //     this.address_almaty.addEventListener('change', () => {
            //         localStorage.setItem('address_almaty', this.address_almaty.value);
            //     })
            // }
            // this.city = document.getElementById('city');
            // if (localStorage.getItem('city')) {
            //     this.city.value = localStorage.getItem('city');
            // }
            // if (this.city) {
            //     this.city.addEventListener('change', () => {
            //         localStorage.setItem('city', this.city.value);
            //     })
            // }
            // this.address_city = document.getElementById('address_city');
            // if (localStorage.getItem('city')) {
            //     this.address_city.value = localStorage.getItem('address_city');
            // }
            // if (this.address_city) {
            //     this.address_city.addEventListener('change', () => {
            //         localStorage.setItem('address_city', this.address_city.value);
            //     })
            // }
            //
            // this.order = document.getElementById('place-an-order');
            // if (this.order) {
            //     this.order.addEventListener('click', this.sendOrder);
            // }
        },
        methods: {
            TabSelect: function (delivery) {
                this.delivery = delivery;
                return false;
            },
            setOrder: function (method) {
                this.delivery = method;
            },
            Delete: function (key) {
                this.list.splice(key, 1);

                UIkit.notification({message: 'Товар успешно удален из корзины!', status: 'success'});
                this.updateList();
            },
            updateList: function () {
                this.count = 0;
                this.summary = 0;
                for (let i = 0; i < this.list.length; i++) {
                    if (this.list[i].count <= 0) {
                        this.list[i].count = 1;
                    }
                    this.count += parseInt(this.list[i].count);

                    this.summary += (this.list[i].count * this.list[i].price);
                }
                localStorage.setItem('basket', JSON.stringify(this.list));
                localStorage.setItem('basket_summary', this.summary);

                if (this.list.length) {
                    this.empty = false;
                } else {
                    this.empty = true;
                }


                // let total = document.getElementById('total_amount');
                // let OrderGo = document.getElementById('OrderGo');
                // if (total) {
                //     if (this.summary) {
                //         OrderGo.style.display = 'block';
                //         total.innerText = this.summary;
                //     } else {
                //         OrderGo.style.display = 'none';
                //     }
                // }
            },
            getData: function () {
                let basket = JSON.parse(localStorage.getItem('basket'));
                let OrderGo = document.getElementById('OrderGo');

                if (basket) {
                    this.empty = false;
                    this.$http.post('/cart/get', basket).then(response => {
                        this.list = response.data.list;
                        this.user = response.data.user;

                        this.email = this.user.email;
                        this.name_ = this.user.name;
                        this.phone = this.user.phone;

                        this.list_present = [];
                        for(let i=0; i<this.list.length;i++) {
                            if(this.list[i].present) {
                                this.list_present.push(this.list[i].present);
                            }
                        }

                        this.updateList();
                    });

                } else {
                    this.empty = true;
                    if (OrderGo) {
                        OrderGo.style.display = 'none';
                    }

                }
            },
            Plus: function (i) {
                this.list[i].count++;
                this.updateList();
            },
            Minus: function (i) {
                this.list[i].count--;
                if (this.list[i].count <= 0) {
                    this.list[i].count = 1;
                }
                this.updateList();
            },
            sendOrder: function () {
                let rules = {
                    email: 'required',
                    name: 'required',
                    phone: 'required',
                    consent: 'true',
                    city: '',
                    address: '',
                };

                if (this.delivery) {
                    rules.address = 'required';
                    this.order_data.address = this.address_city || "";
                }

                this.order_data.consent = this.consent;
                this.order_data.email = this.email;
                this.order_data.name = this.name_;
                this.order_data.phone = this.phone;
                this.order_data.delivery = this.delivery;
                this.order_data.list_product = this.list;

                if (this.$validator.run(this.order_data, rules)) {

                    console.log(this.order_data);

                    this.$http.post('/order/create', this.order_data).then(response => {
                        let data = response.data;
                        console.log(data);
                        if (data.result) {
                            localStorage.setItem('basket', JSON.stringify([]));
                            localStorage.setItem('basket_summary', 0);
                            setTimeout(function () {
                                location.href = data.redirect_to;
                            }, 300);
                        } else {
                            console.error(data.errors);
                            for (let n in data.errors) {
                                data.errors[n].forEach(function (i) {
                                    console.log(i);
                                    UIkit.notification({message: i, status: 'danger'});
                                });
                            }

                        }

                    })

                }
            },
        },
        watch: {
            list: function (i) {
            },
            city: function (i) {
                this.address_city = 'г.' + i + ' ул.' + this.street + ' дом.' + this.home + ' кв.' + this.flat;
            },
            street: function (i) {
                this.address_city = 'г.' + this.city + ' ул.' + i + ' дом.' + this.home + 'кв.' + this.flat;
            },
            home: function (i) {
                this.address_city = 'г.' + this.city + ' ул.' + this.street + ' дом.' + i + ' кв.' + this.flat;
            },
            flat: function (i) {
                this.address_city = 'г.' + this.city + ' ул.' + this.street + ' дом.' + this.home + ' кв.' + i;
            },

        },
    }
</script>
<style>
    .presents{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 20px;
    }
    .presents li {margin-right: 15px;}
    .presents li::after {content: ","}

</style>
