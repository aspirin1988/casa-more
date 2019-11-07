<template>
    <article class="uk-comment uk-textarea uk-position-relative">
        <header class="uk-comment-header uk-question-grid">
            <div>
                <h4 class="uk-comment-title uk-margin-remove">
                    <a :href="'/admin/media_list/'+item.dir_name" class="uk-link-reset" :title="'Папка: '+ item.dir_name" >{{item.dir_name}}</a>
                </h4>
                <ul class="uk-comment-meta uk-list uk-child-padding-remove">
                    <li>
                        <a class="uk-link-muted" href="#" :title="'Количество изображений: '+item.count_image">
                            Количество:<strong>{{item.count_image}}</strong>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="uk-comment-footer uk-padding-small" :class="classObject">
                <a class="uk-button uk-button-default uk-background-muted uk-button-secondary" :href="'/admin/media_list/'+item.dir_name">
                    <span class="uk-text-success" uk-icon="file-edit"></span>
                </a>
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
            del:function () {
                this.$emit('Delete', this.item);
            }
        }
    }
</script>
