<template>
    <article class="uk-comment uk-textarea uk-position-relative">
        <header class="uk-comment-header uk-question-grid">
            <div>
                <h4 class="uk-comment-title uk-margin-remove">
                    <a :href="'#'" class="uk-link-reset"
                       v-html=" (item ? (item.user.first_name || '') +' '+(item.user.last_name||''):'')"></a>
                </h4>
                <ul class="uk-comment-meta uk-list uk-child-padding-remove">
                    <li>
                        <a class="uk-link-muted" href="#">
                            ID:<strong>{{(item ? item.id : '')}}</strong>
                        </a>
                    </li>
                    <li>
                        <a class="uk-link-muted" href="#">
                            Тел:<a :href="'tel:'+item.user.phone">{{(item?item.user.phone:'')}}</a>
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
                <span class="uk-button uk-button-primary" @click="Check()" :href="'#'">
                    <span uk-icon="check"></span>
                </span>
                <span v-if="item.status!==3" class="uk-button uk-button-danger" @click="Ban()" :href="'#'">
                    <span uk-icon="ban"></span>
                </span>
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
        props: ['item'],
        data() {
            return {
                status: ['Новый', 'Принят', 'Выполнен', "Отменен"],
            }
        },
        mounted() {
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
            },
            Ban: function () {
                this.item.status = 3;
                this.Update();
            },
            Check: function () {
                if (this.item.status === 0) {
                    this.item.status = 1;
                    this.Update();
                } else if (this.item.status === 1) {
                    this.item.status = 2;
                    this.Update();
                } else if (this.item.status === 3) {
                    this.item.status = 1;
                    this.Update();
                }


            },
            Update: function () {
                this.$http.post('/admin/order/update/' + this.item.id, this.item).then(response => {
                    this.$emit('Update', this.item)
                });

            }
        }
    }
</script>
