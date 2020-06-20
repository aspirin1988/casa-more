<template>
    <div class="search-modal">
        <div class="search-modal-title">
            Поиск по сайту
        </div>
        <div class="uk-search-cover">
            <div class="uk-inline uk-width-1-1@l">
                <a href="#" class="uk-form-icon uk-form-icon-flip uk-icon" @click="toSearch()">
                    <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                         data-svg="search">
                        <circle fill="none" stroke="#000" stroke-width="1.1" cx="9" cy="9" r="7"></circle>
                        <path fill="none" stroke="#000" stroke-width="1.1" d="M14,14 L18,18 L14,14 Z"></path>
                    </svg>
                </a>
                <input v-model="search" @keypress="getSearch($event)" placeholder="Найти" type="text"
                       class="uk-border-rounded uk-input">
            </div>
            <ul v-if="list.length" class="uk-list uk-search-list">
                <li v-for="item in list"><a :href="item.url" v-html="item.name"></a></li>
            </ul>
        </div>
        <div class="container">
            <div class="CardWr" v-for="item in search_list">
                <div class="CardBox">
                    <div class="CardDiscount">
                    </div>
                    <div class="CardBoxImg">
                        <img id="green_monster" :src="item.thumb"
                             :data-big="item.thumb">
                    </div>
                    <div class="CardBoxDesc">
                        <!--                        <p>Массажные кресла</p>-->
                        <h5>{{item.name}}</h5>
                        <div class="CardBoxPrice">
                            <span>{{item.price}} <b>тг</b></span>
                        </div>
                    </div>
                    <a :href="item.url"></a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                search: '',
                list: [],
                search_list: [],
                t: '',
            }
        },
        mounted() {
            this.t = location.search.split('?t=')[1];

            this.t = decodeURI(this.t);

            if (this.t) {
                this.getGrid()
            }


        },
        methods: {
            getGrid: function () {
                this.$http.post('/help/find', {'search': this.t}).then(response => {
                    this.search_list = response.data;
                });
            },
            toSearch: function () {
                location.href = '/search/?t=' + this.search;
                return false;
            },
            getSearch: function (e) {

                let code = e.keyCode;

                if (this.search.length >= 2) {
                    this.$http.post('/help/find', {'search': this.search}).then(response => {
                        this.list = response.data;
                    });
                } else {
                    this.list = [];
                }

                if (code == 13) {
                    location.href = '/search/?t=' + this.search;
                }

            }
        }
    }
</script>

<style>
    .uk-search-cover + .container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-gap: 20px;
        margin: 40px auto;
    }

    .CardBox .CardBoxImg > img {
        max-height: 270px;
    }
</style>
