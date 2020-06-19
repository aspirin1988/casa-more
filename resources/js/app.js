/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var SocialSharing = require('vue-social-sharing');
import VueMask from 'v-mask'

window.Vue = require('vue');

Vue.use(VueMask);
Vue.use(SocialSharing);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('home_page-component', require('./components/HomePage.vue').default);

Vue.component('madia_list-component', require('./components/Media/List.vue').default);
Vue.component('media_list_item-component', require('./components/Media/ListItem.vue').default);
Vue.component('image_list-component', require('./components/Media/ImageList').default);
Vue.component('image_list_item-component', require('./components/Media/ImageListItem').default);

Vue.component('page_list-component', require('./components/Page/PageList.vue').default);
Vue.component('page_list_item-component', require('./components/Page/PageListItem.vue').default);
Vue.component('page_add-component', require('./components/Page/PageAdd.vue').default);
Vue.component('page_edit-component', require('./components/Page/PageEdit.vue').default);

Vue.component('rubric_list-component', require('./components/Rubric/RubricList.vue').default);
Vue.component('rubric_list_item-component', require('./components/Rubric/RubricListItem.vue').default);
Vue.component('rubric_add-component', require('./components/Rubric/RubricAdd.vue').default);
Vue.component('rubric_edit-component', require('./components/Rubric/RubricEdit.vue').default);


Vue.component('order_list-component', require('./components/Order/List.vue').default);
Vue.component('order_list_item-component', require('./components/Order/ListItem.vue').default);

Vue.component('brand_list-component', require('./components/Brand/List.vue').default);
Vue.component('brand_list_item-component', require('./components/Brand/ListItem.vue').default);
Vue.component('brand_add-component', require('./components/Brand/Add.vue').default);
Vue.component('brand_edit-component', require('./components/Brand/Edit.vue').default);


Vue.component('slider_list-component', require('./components/Slider/List.vue').default);
Vue.component('slider_list_item-component', require('./components/Slider/ListItem.vue').default);
Vue.component('slider_add-component', require('./components/Slider/Add.vue').default);
Vue.component('slider_edit-component', require('./components/Slider/Edit.vue').default);

Vue.component('user_list-component', require('./components/User/List.vue').default);
Vue.component('user_edit-component', require('./components/User/Edit.vue').default);

Vue.component('product_list-component', require('./components/Product/List.vue').default);
Vue.component('product_list_item-component', require('./components/Product/ListItem.vue').default);
Vue.component('product_add-component', require('./components/Product/Add.vue').default);
Vue.component('product_edit-component', require('./components/Product/Edit.vue').default);

Vue.component('present_list-component', require('./components/Present/List.vue').default);
Vue.component('present_list_item-component', require('./components/Present/ListItem.vue').default);
Vue.component('present_add-component', require('./components/Present/Add.vue').default);
Vue.component('present_edit-component', require('./components/Present/Edit.vue').default);

Vue.component('tag_list-component', require('./components/Tag/List.vue').default);
Vue.component('tag_list_item-component', require('./components/Tag/ListItem.vue').default);
Vue.component('tag_add-component', require('./components/Tag/Add.vue').default);
Vue.component('tag_edit-component', require('./components/Tag/Edit.vue').default);

Vue.component('basket_button-component', require('./components/Basket/button').default);
Vue.component('product-comparison-component', require('./components/Product/Comparison.vue').default);
Vue.component('cart-component', require('./components/Basket/cart').default);
Vue.component('tag-product-list-component', require('./components/Product/TagProductList.vue').default);
Vue.component('brand-product-list-component', require('./components/Product/BrandProductList').default);


Vue.component('widget-search-product-component', require('./components/Widget/SearchProduct.vue').default);
Vue.component('widget-search-product-m-component', require('./components/Widget/SearchProductMobile.vue').default);

Vue.component('widget-reset_password-component', require('./components/User/ResetPassword.vue').default);
Vue.component('widget-update-component', require('./components/User/Update.vue').default);
Vue.component('widget-paginator-component', require('./components/Widget/Paginator.vue').default);
Vue.component('widget-paginator-new-component', require('./components/Widget/PaginatorNew.vue').default);
Vue.component('widget-sub_menu-component', require('./components/Widget/SubMenu.vue').default);
Vue.component('widget-preloader-component', require('./components/Widget/Preloader.vue').default);
Vue.component('single-item-component', require('./components/Widget/SingleItem.vue').default);
Vue.component('add-push-component', require('./components/Widget/AddPush.vue').default);
Vue.component('super-queue-component', require('./components/Widget/SuperQueue.vue').default);
Vue.component('html-editor-component', require('./components/Widget/HtmlEditor.vue').default);
Vue.component('share-component', require('./components/Widget/Share.vue').default);

Vue.component('form-reset-component', require('./components/Widget/ResetForm.vue').default);

Vue.prototype.$http = axios;

Vue.prototype.$ru = {
    authors: "Авторы",
    name: "Имя",
    name_: "Название",
    commentable: "Может комментироваться",
    header: "Заголовок",
    title: "Заголовок",
    rubric_id: "Рубрики",
    'super': "СУПЕР",
    text: "Текст",
    bio: "Текст",
    announce: "Анонс",
    top: "ТОП",
    author_promis: 'Кто обещал',
    complete: 'Статус обещания',
    date_end: 'Дата конца обещания',
    author_id: 'Автор',
    interviewees: 'ФИО выступающего',
    opponent1_name: 'ЗА - Имя',
    opponent1_opinion: 'ЗА - Мнение',
    opponent1_job: 'ЗА - Описание',
    opponent1_photo_main: 'Фото',
    opponent1_photo_inside: 'Фото',
    opponent2_name: 'ПРОТИВ - Имя',
    opponent2_opinion: 'ПРОТИВ - Мнение',
    opponent2_job: 'ПРОТИВ - Описание',
    opponent2_photo_main: 'Фото',
    opponent2_photo_inside: 'Фото',
    fio: 'ФИО',
    email: 'Email',
    years_life: 'Годы жизни',
    birth_place: 'Место рождения',
    army_type: 'Род войск',
    job_title: 'Название работы',
    description: 'Описание',
    date: 'Дата',
    mail: 'Email',
    position: 'Должность',
    phone: 'Телефон',
    videocode: 'Видео',
    keyword: 'Ключевое слово',
    consent: 'Согласие',
    address: 'Адрес',
    city: 'Город',
};

Vue.prototype.$validator = {
    run: function (fields, rules) {
        let result = true;
        for (let field in rules) {
            let rule = rules[field];
            switch (rule) {
                case 'required':
                    switch (typeof fields[field]) {
                        case 'undefined':
                            result = false;
                            UIkit.notification({
                                message: 'Поле <strong class="' + field + '" >' + Vue.prototype.$ru[field] + '</strong> не может быть пустым !',
                                status: 'danger'
                            });
                            break;
                        case 'object':
                            if (!fields[field].length) {
                                result = false;
                                UIkit.notification({
                                    message: 'Поле <strong>' + Vue.prototype.$ru[field] + '</strong> не может быть пустым !',
                                    status: 'danger'
                                });
                            }
                            break;
                        case 'string':
                            if (!fields[field].length) {
                                result = false;
                                UIkit.notification({
                                    message: 'Поле <strong>' + Vue.prototype.$ru[field] + '</strong> не может быть пустым !',
                                    status: 'danger'
                                });
                            }
                            break;
                    }
                    break;

                case 'true':
                    if (fields[field] !== true) {
                        result = false;
                        UIkit.notification({
                            message: 'Поле <strong>' + Vue.prototype.$ru[field] + '</strong> является обязательным для заполнения !',
                            status: 'danger'
                        });
                    }
                    break;
            }
        }
        return result;
    }
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});


(function () {
    window.addEventListener('load', function () {
        function initMap() {
            var uluru = {lat: 43.2489657, lng: 76.8939094};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                scrollwheel: false,
                center: uluru
            });
            var marker = new google.maps.Marker({
                position: {lat: 43.238183, lng: 76.8499593},
                map: map
            });
            var marker1 = new google.maps.Marker({
                position: {lat: 43.2619971, lng: 76.9473844},
                map: map
            });
            var marker1 = new google.maps.Marker({
                position: {lat: 43.2423859, lng: 76.9270723},
                map: map
            });
        }
    })
})();
