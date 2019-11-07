<template>
    <article class="uk-comment uk-textarea uk-position-relative">
        <header class="uk-comment-header uk-question-grid">
            <div>
                <h4 class="uk-comment-title uk-margin-remove">
                    <a class="uk-link-reset">{{item.name}}</a>
                </h4>
                <img :src="item.image" :style="{width:'90px'}" alt="">
            </div>
            <div class="uk-comment-footer uk-padding-small" :class="classObject">
                <button @click="del(item)" class="uk-button uk-button-danger">
                    <span uk-icon="trash"></span>
                </button>
            </div>
        </header>
        <div class="uk-comment-body uk-position-relative">
            <hr>
            <p class="uk-padding-small uk-padding-remove-top" v-html="item.description"></p>
        </div>
    </article>
</template>

<script>
    export default {
        props: {
            item: {
                type: Object,
                required: true
            }
        },
        data() {
            return {}
        },
        computed: {
            classObject: function () {
                return {
                    'uk-status-published': this.item.status == true,
                    'uk-status-new': this.item.status == false,
                }
            }
        },
        methods: {
            del: function () {
                this.$emit('Delete', this.item);
            }
        }
    }
</script>
