<template>
    <ul class="uk-filter-list">
        <li v-for="item in items" :class="setActive(item)" >
            <a :href="''+item.url+(rubric_id?'/1/'+rubric_id:'')">{{item.text}}</a>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['items', 'rubric_id'],
        data() {
            return {
                padding:30,
            }
        },
        mounted() {

            this._menu = this.$el;
            this._item = this.$el.querySelector('.uk-active');

            let offset = 0;
            if(this._item) {
                offset = this._item.offsetLeft - (this._item.clientHeight + this.padding);
            }

            this._menu.scrollLeft = offset;
        },
        methods:{
            setActive: function (item) {
                let path = window.location.pathname;
                for (let i = 0; i < item.alias.length; i++) {
                    if (path.indexOf(item.alias[i]) + 1) {
                        return {'uk-active': true}
                    }

                }

                return {}
            }
        },
        computed: {

        }
    }
</script>
