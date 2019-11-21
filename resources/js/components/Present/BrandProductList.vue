<template>
    <div>
        <div uk-grid>
            <div class="uk-width-3-5@s">
                <ul class="uk-breadcrumb">
                    <li class="uk-disabled">
                        <span class="uk-h1 uk-text-large uk-text-uppercase">{{brand_data.name}}</span></li>
                    <li><a href="/">Главная</a></li>
                </ul>
            </div>
            <div class="uk-width-2-5@s uk-flex uk-flex-right">
                <ul class="uk-filter">
                    <li><span class="uk-filter-heading">Сортировка:</span></li>
                    <li>
                        <span class="uk-button uk-button-small uk-text-bold" :class="{'uk-active':sort==='name'}"
                              @click="setSortField('name')">
                            По названию
                            <span v-if="sort == 'name' && sort_method == 'desc'" uk-icon="triangle-up"></span>
                            <span v-if="sort == 'name' && sort_method =='asc'" uk-icon="triangle-down"></span>
                        </span>
                    </li>
                    <li><span class="uk-button uk-button-small uk-text-bold" :class="{'uk-active':sort==='price'}"
                              @click="setSortField('price')">
                        по цене
                        <span v-if="sort == 'price' && sort_method == 'desc'" uk-icon="triangle-up"></span>
                        <span v-if="sort == 'price' && sort_method =='asc'" uk-icon="triangle-down"></span>
                    </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="uk-card uk-card-default uk-filter-grid">
            <div class="uk-margin-right uk-position-relative">
                <p class="uk-margin-remove uk-filter-grid-title">Цена:</p>
                <i id="show_filter" class="uk-position-center-right uk-hidden@s" @click="showFilter()"
                   uk-icon="chevron-down"></i>
            </div>
            <div class="uk-filter-grid-price" :class="{'uk-active':show_filter, 'uk-animation-scale-up':show_filter}">
                <label class="uk-form-label uk-min-price">
                    <input id="min-price" type="text" v-model="min_" @change="getList()"
                           class="uk-input uk-form-width-small">
                </label>
                <div class='multi-range'>
                    <hr/>
                    <!--<div id="progress" ></div>-->
                    <input id="form-h-range-1" class="uk-range" @change="getList()" type='range' :min='min' :max="max-5"
                           step='5'
                           v-model="min_">
                    <input id="form-h-range-2" class="uk-range" @change="getList()" type='range' :min="min+5" :max="max"
                           step='5'
                           v-model="max_">
                </div>

                <label class="uk-form-label uk-max-price">
                    <input id="max-price" type="text" v-model="max_" @change="getList()"
                           class="uk-input uk-form-width-small ">
                </label>


            </div>
            <div class="uk-divider-container uk-visible@s">
                <div class="uk-divider-vertical"></div>
                <div class="uk-divider-vertical"></div>
            </div>
            <div class="uk-filter-grid-reset" :class="{'uk-active':show_filter, 'uk-animation-scale-up':show_filter}">
                <button type="reset" class="uk-button uk-button-default uk-border-rounded">
                    сбросить фильтры
                </button>
            </div>
        </div>
        <div class="lg-grid-product uk-tab-grid uk-custom-grid-collapse">
            <div class="lg-grid-product-item" v-for="item in list">
                <ul class="uk-switcher" :class="classObject(item.id)">
                    <li>
                        <ul class="lg-tags">
                            <li v-for="tag in item.tags">
                                <a :class="classObject_(tag.data.keyword)" :href="'/'+tag.data.keyword+'/'"></a>
                            </li>
                        </ul>
                    </li>
                    <li v-for="child in item.child">
                        <ul class="lg-tags">
                            <li v-for="tag in child.tags">
                                <a :class="classObject_(tag.data.keyword)" :href="'/'+tag.data.keyword+'/'"></a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="uk-switcher" :class="classObject(item.id)">
                    <li>
                        <a :href="item.url">
                            <div class="lg-background-cover" :style="{backgroundImage: setThumb(item)}">
                                <canvas style="width: 260px; height: 260px "></canvas>
                            </div>
                        </a>
                    </li>
                    <li v-for="child in item.child">
                        <a :href="child.url+'?v='+child.volume">
                            <div class="lg-background-cover" :style="{backgroundImage: setThumb(item)}">
                                <canvas style="width: 260px; height: 260px "></canvas>
                            </div>
                        </a>
                    </li>
                </ul>
                <a :href="item.url" class="uk-link-reset uk-text-center">
                    <h3 class="uk-card-title">{{item.name}}</h3>
                    <ul class="uk-switcher" :class="classObject(item.id)">
                        <li>
                            <span v-if="item.discount" class="price-discount">{{item.price - ((item.price/100)*item.discount) }} тг</span>
                            <span v-if="item.discount" class="price-old">{{item.price}} тг</span>

                            <span v-if="!item.discount" class="price">{{item.price}} тг</span>
                        </li>
                        <li v-for="child in item.child">
                            <span v-if="child.discount" class="price-discount">{{child.price - ((child.price/100)*child.discount) }} тг</span>
                            <span v-if="child.discount" class="price-old">{{child.price}} тг</span>

                            <span v-if="!child.discount" class="price">{{child.price}} тг</span>
                        </li>
                    </ul>
                </a>
                <ul class="volume-list" :uk-switcher="'connect: .switcher-container_'+item.id">
                    <li class="uk-active" :style="{'opacity':item.volume}">
                        <a href="#">{{item.volume}} ml</a>
                    </li>
                    <li v-for="child in item.child" :style="{'opacity':item.volume}">
                        <a href=#>{{child.volume}} ml</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="uk-flex uk-flex-center">
            <ul class="uk-pagination" uk-margin>
                <li class="uk-cursor-pointer " :class="{'uk-disabled':page==0}" @click="prevPage()"><span href="#"><span
                        uk-pagination-previous></span></span></li>
                <li class="uk-cursor-pointer" v-for="item in page_list" :class="{'uk-active': item === page}"
                    @click="selectPage(item)"><span>{{item+1}}</span></li>
                <li class="uk-cursor-pointer" :class="{'uk-disabled':page==pages}" @click="prevNext()"><span><span
                        uk-pagination-next></span></span></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['brand'],
        data() {
            return {
                page_list: [],
                load: false,
                list: [],
                page: 0,
                pages: 0,
                sort: 'name',
                sort_method: 'asc',
                brand_data: {},
                max: 0,
                min: 0,
                max_: 0,
                min_: 0,
                show_filter: false,
            }
        },
        mounted() {
            this.getList();
        },
        methods: {
            showFilter: function () {
                this.show_filter = !this.show_filter;
            },
            setMax: function (e) {
                console.log(e.target.value);
                this.max = e.target.value;
                this.max_ = e.target.value;
            },
            setMin: function (e) {
                console.log(e.target.value);
                this.min = e.target.value;
                this.min_ = e.target.value;
            },
            setSortField: function (field) {
                if (this.sort === field) {
                    this.sort_method = (this.sort_method === 'asc' ? 'desc' : 'asc');
                }
                this.sort = field;
                this.getList();
            },
            prevPage: function () {
                this.page--;
                this.page = (this.page < 0 ? 0 : this.page);
                this.getList();
            },
            prevNext: function () {
                this.page++;
                this.page = (this.page > this.pages ? this.pages : this.page);
                this.getList();
            },
            selectPage: function (page) {
                this.page = page;
                this.getList();
            },
            getList: function () {
                let data = {};
                data.brand = this.brand;
                data.page = this.page;
                data.sort = this.sort;
                data.sort_method = this.sort_method;
                data.min = this.min_;
                data.max = this.max_;
                this.$http.post('/product/get/list_by_brand', data).then(response => {
                    this.list = response.data.list;
                    this.page_list = response.data.page_list;
                    this.pages = response.data.pages;
                    this.brand_data = response.data.brand_data;

                    if (!this.max)
                        this.max = response.data.max;
                    if (!this.min)
                        this.min = response.data.min;
                    if (!this.max_)
                        this.max_ = response.data.max;
                    if (!this.min_)
                        this.min_ = response.data.min;
                    this.load = true;
                });
            },
            setThumb: function (item) {

                if (item.image && item.image.thumb_bottle) {

                    let image = item.image.thumb_bottle;
                    let url = "url('" + image + "')";
                    console.log(url);
                    return url;
                } else {
                    console.log(item);
                    return 'url(/img/empty.png)';
                }
            },
            classObject: function (id) {
                let switcher = 'switcher-container_' + id;
                let data = {};
                data[switcher] = true;
                return data
            },
            classObject_: function (keyword) {
                let lg_icon = 'lg-icon-' + keyword;
                let data = {};
                data[lg_icon] = true;
                return data
            }
        },
        computed: {},
        watch: {
            // max_: function (data) {
            //     this.getList()
            // },
            // min_: function (data) {
            //     this.getList()
            // }
        }
    }
</script>

<style>
    .uk-cursor-pointer {
        cursor: pointer;
    }
    .uk-h1{
        font-family: "PT Sans", sans-serif;
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 0;
        color: #000;
    }
</style>

