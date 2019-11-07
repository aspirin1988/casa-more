<template>
    <article class="uk-comment uk-textarea uk-position-relative">
        <header class="uk-comment-header uk-question-grid">
            <div>
                <h4 class="uk-comment-title uk-margin-remove">
                    <a :href="'#'" class="uk-link-reset"
                       v-html="item.user.first_name+' '+(item.user.last_name||'')"></a>
                </h4>
                <ul class="uk-comment-meta uk-list uk-child-padding-remove">
                    <li>
                        <a class="uk-link-muted" href="#">
                            ID:<strong>{{item.id}}</strong>
                        </a>
                    </li>
                    <li>
                        <a class="uk-link-muted" href="#">
                            Тел:<a :href="'tel:'+item.user.phone">{{item.user.phone}}</a>
                        </a>
                    </li>
                    <li>
                        <a class="uk-link-muted" href="#">
                            Статус:<strong>{{getStatus(item.status)}}</strong>
                        </a>
                    </li>
                    <li>
                        <a class="uk-link-muted" href="#">
                            <span>Отредактировано:</span>
                            <strong>{{item.updated_at}}</strong>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="uk-comment-footer uk-padding-small" :class="classObject">
                <a class="uk-button uk-button-default uk-background-muted uk-button-secondary"
                   :href="'#'">
                    <span class="uk-text-success" uk-icon="file-edit"></span>
                </a>
            </div>
        </header>
        <div class="uk-comment-body uk-position-relative">
            <table class="uk-table uk-table-hover uk-table-divider">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Present</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="val in item.products">
                    <td>{{val.id}}</td>
                    <td>{{val.name}}</td>
                    <td>{{val.present}}</td>
                </tr>

                </tbody>
            </table>

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
            return {
                status: ['Новый', 'Оплачен', 'В обработке'],
            }
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
            getStatus: function (status) {
                return this.status[status];
            },
            del: function () {
                this.$emit('Delete', this.item);
            }
        }
    }
</script>
