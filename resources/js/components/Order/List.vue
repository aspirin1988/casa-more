<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Заказы</h2></div>
            <widget-sub_menu-component :items="menu"></widget-sub_menu-component>
        </header>
        <div class="uk-margin-top">
            <div v-if="list.length">
                <widget-paginator-component :key="'upp'" :list="page_list" :current_page="current_page"
                                            :path="'/admin/brand/'"></widget-paginator-component>
                <ul class="uk-comment-list">
                    <li v-for="item in list">
                        <order_list_item-component :item="item" :key="item.id" @Update="Update"  @Delete="Delete"></order_list_item-component>
                        <!--                        <article v-if="item"  class="uk-comment uk-textarea uk-position-relative">-->
                        <!--                            <header class="uk-comment-header uk-question-grid">-->
                        <!--                                <div>-->
                        <!--                                    <h4 class="uk-comment-title uk-margin-remove">-->
                        <!--                                        <a :href="'#'" class="uk-link-reset"-->
                        <!--                                           v-html=" (item.user ? (item.user.first_name || '') +' '+(item.user.last_name||''):'')"></a>-->
                        <!--                                    </h4>-->
                        <!--                                    <ul class="uk-comment-meta uk-list uk-child-padding-remove">-->
                        <!--                                        <li>-->
                        <!--                                            <a class="uk-link-muted" href="#">-->
                        <!--                                                ID:<strong>{{(item ? item.id : '')}}</strong>-->
                        <!--                                            </a>-->
                        <!--                                        </li>-->
                        <!--                                        <li>-->
                        <!--                                            <a class="uk-link-muted" href="#">-->
                        <!--                                                Тел:<a :href="'tel:'+( item.user ? item.user.phone : '')">{{( item.user ? item.user.phone : '')}}</a>-->
                        <!--                                            </a>-->
                        <!--                                        </li>-->
                        <!--                                        <li>-->
                        <!--                                            <a class="uk-link-muted" href="#">-->
                        <!--                                                Статус:<strong>{{getStatus(item.status)}}</strong>-->
                        <!--                                            </a>-->
                        <!--                                        </li>-->
                        <!--                                        <li>-->
                        <!--                                            <a class="uk-link-muted" href="#">-->
                        <!--                                                <span>Отредактировано:</span>-->
                        <!--                                                <strong>{{item.updated_at}}</strong>-->
                        <!--                                            </a>-->
                        <!--                                        </li>-->
                        <!--                                    </ul>-->
                        <!--                                </div>-->
                        <!--                                <div class="uk-comment-footer uk-padding-small" :class="classObject">-->
                        <!--&lt;!&ndash;                                    <a class="uk-button uk-button-default uk-background-muted uk-button-secondary"&ndash;&gt;-->
                        <!--&lt;!&ndash;                                       :href="'#'">&ndash;&gt;-->
                        <!--&lt;!&ndash;                                        <span class="uk-text-success" uk-icon="file-edit"></span>&ndash;&gt;-->
                        <!--&lt;!&ndash;                                    </a>&ndash;&gt;-->
                        <!--                                </div>-->
                        <!--                            </header>-->
                        <!--                            <div class="uk-comment-body uk-position-relative">-->
                        <!--                                <table class="uk-table uk-table-hover uk-table-divider">-->
                        <!--                                    <thead>-->
                        <!--                                    <tr>-->
                        <!--                                        <th>Id</th>-->
                        <!--                                        <th>Name</th>-->
                        <!--                                        <th>Present</th>-->
                        <!--                                    </tr>-->
                        <!--                                    </thead>-->
                        <!--                                    <tbody>-->
                        <!--                                    <tr v-for="val in item.products" v-if="val">-->
                        <!--                                        <td>{{val.id}}</td>-->
                        <!--                                        <td>{{val.name}}</td>-->
                        <!--                                        <td>{{val.present}}</td>-->
                        <!--                                    </tr>-->

                        <!--                                    </tbody>-->
                        <!--                                </table>-->

                        <!--                            </div>-->
                        <!--                        </article>-->
                    </li>
                </ul>
                <widget-paginator-component :key="'down'" :list="page_list" :current_page="current_page"
                                            :path="'/admin/brand/'"></widget-paginator-component>
            </div>
            <div v-else="" class="uk-margin-top">
                <widget-preloader-component :load="load"></widget-preloader-component>
            </div>
        </div>
        <div id="delete-save" ref="delete-save" uk-modal>
            <div class="uk-modal-dialog uk-modal-body">
                <h2 class="uk-modal-title uk-text-warning">Предупреждение!</h2>
                <p> Вы действительно хотите удалить материал?</p>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Нет</button>
                    <button class="uk-button uk-button-primary" @click="deletePage" type="button">ДА!</button>
                </p>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['current_page', 'method'],
        data() {
            return {
                list: {},
                page_list: null,
                load: false,
                delete_item: {},
                delete_dialog: false,
                path: window.location.pathname,
                status: ['Новый', 'Принят', 'Выполнен', "Отменен"],
                menu: [
                    {id: 1, url: '/admin/orders/all', text: "Все", alias: ['/admin/orders/all']},
                    {id: 2, url: '/admin/orders/new', text: "Новый", alias: ['/admin/orders/new']},
                    {id: 3, url: '/admin/orders/in-process', text: "Принят", alias: ['/admin/orders/in-process']},
                    {id: 4, url: '/admin/orders/complete', text: "Выполнен", alias: ['/admin/orders/complete']},
                    {id: 5, url: '/admin/orders/reject', text: "Отменен", alias: ['/admin/orders/reject']},
                ],

            }
        },
        mounted() {
            this.delete_dialog = this.$refs['delete-save'];

            this.getList();
        },
        methods: {
            getList: function () {
                this.$http.get('/admin/order/get_list/' + this.method).then(response => {
                    let data = response.data;
                    this.list = data.list;
                    this.page_list = data.page_list;
                    this.load = true;
                });
            },
            Delete: function (item) {
                this.delete_item = item;
                UIkit.modal(this.delete_dialog).show();
            },
            Update: function () {
                this.getList();
            },
            deletePage: function (item) {
                this.$http.delete('/admin/brand/delete/' + this.delete_item.id).then(response => {
                    UIkit.modal(this.delete_dialog).hide();
                    this.getList();
                });
            },
            getStatus: function (status) {
                return this.status[status];
            },
            del: function (item) {
                this.Delete(item);
            },
            classObject: function (item) {
                return {
                    'uk-status-published': item.status == true,
                    'uk-status-new': item.status == false,
                }
            }

        },

    }
</script>
