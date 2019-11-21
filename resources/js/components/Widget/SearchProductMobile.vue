<template>
    <div style="margin-top: 20px">
        <div class="uk-inline uk-width-1-1@l">
            <a class="uk-form-icon uk-form-icon-flip uk-icon" href="#" uk-icon="icon: search" style="color: #0b978c;">
                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                     data-svg="search">
                    <circle fill="none" stroke="#000" stroke-width="1.1" cx="9" cy="9" r="7"></circle>
                    <path fill="none" stroke="#000" stroke-width="1.1" d="M14,14 L18,18 L14,14 Z"></path>
                </svg>
            </a>
            <input v-model="search" @keypress="getSearch()" @keyup="getSearch()" @change="getSearch()" class="uk-border-rounded uk-input"
                   placeholder="Более 10 000 товаров в наличии" type="text">
            <ul v-if="list.length" class="uk-list uk-search-list">
                <li v-for="item in list"><a :href="item.url" v-html="item.name" ></a></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                search: '',
                list: [],
            }
        },
        methods:{
            getSearch: function () {
                if (this.search.length >= 2) {
                    this.$http.post('/help/find', {'search': this.search}).then(response => {
                        this.list = response.data;
                    });
                } else {
                    this.list = [];
                }
            }
        }
    }
</script>
