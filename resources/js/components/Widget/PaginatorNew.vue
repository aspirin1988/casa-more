<template>
    <ul class="uk-pagination uk-flex-center" v-if="list" uk-margin>
        <li><a v-if="current_page!=1" :href="'#'" @click="setPage(current_page-1)"><span uk-pagination-previous></span></a>
        </li>
        <li v-if="current_page>4"><a :href="'#'" @click="setPage(1)">1</a></li>
        <li v-if="current_page>4" class="uk-disabled"><span>...</span></li>
        <li v-for="item in list" :class="{'uk-active':item==current_page}"><a :href="'#'" @click="setPage(item)">{{item}}</a>
        </li>
        <li><a :href="'#'" @click="setPage(current_page+1)"><span uk-pagination-next></span></a></li>
    </ul>
</template>

<script>
    export default {
        props: {
            list: null,
            current_page: {
                type: Number
            },
            path: {},
            rubric_id: {},

        },
        data() {
            return {}
        },
        methods: {
            setPage: function (page) {
                this.$emit('SetPage', page);
                event.preventDefault();
                return false;
            },
        }
    }
</script>