<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Подарки
                    <div class="uk-inline">
                        <button class="uk-button uk-button-primary uk-button-small uk-border-rounded" type="button"
                                uk-icon="plus"></button>
                        <div uk-dropdown>
                            <ul class="uk-nav uk-nav-default">
                                <li class="">
                                    <a href="/admin/present/add" title="Подарки">
                                        <i uk-icon="template"></i><span>Подарки</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </h2>
            </div>
        </header>
        <div class="uk-margin-top">
            <div v-if="list.length">
                <widget-paginator-new-component @SetPage="setPage" :key="'down'" :list="page_list"
                                                :current_page="current_page"
                                                :path="'/admin/present/'"></widget-paginator-new-component>
                <ul class="uk-comment-list">
                    <li v-for="item in list">
                        <present_list_item-component :item="item" :key="item.id"
                                                     @Delete="Delete"></present_list_item-component>
                    </li>
                </ul>
                <widget-paginator-new-component @SetPage="setPage" :key="'down'" :list="page_list"
                                                :current_page="current_page"
                                                :path="'/admin/present/'"></widget-paginator-new-component>
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
                list: [],
                page_list: null,
                load: false,
                delete_item: {},
                delete_dialog: false,
                path: window.location.pathname,
                sort: 'name',
                sort_method: 'asc',
                page: 1,
                menu: [
                    // {id: 1, url: '/admin/present/massage_chairs', text: "Массажные кресла", alias: ['/admin/present/massage_chairs']},
                    // {id: 2, url: '/admin/present/massagers', text: "Массажеры", alias: ['/admin/present/massagers']},
                    // {id: 3, url: '/admin/present/fitness_equipment', text: "Фитнес оборудование", alias: ['/admin/present/fitness_equipment']},
                    // {id: 4, url: '/admin/present/household_presents', text: "Товары для дома", alias: ['/admin/present/household_presents']},
                ],
            }
        },
        mounted() {
            this.delete_dialog = this.$refs['delete-save'];

            this.getList();
        },
        methods: {
            setPage: function (page) {
                this.current_page = page;
                this.getList();
            },
            setSortField: function (field) {
                if (this.sort === field) {
                    this.sort_method = (this.sort_method === 'asc' ? 'desc' : 'asc');
                }
                this.sort = field;
                this.getList();
            },
            getList: function () {
                let data = {};
                data.page = this.current_page;
                data.sort = this.sort;
                data.sort_method = this.sort_method;

                this.$http.post('/admin/present/get', data).then(response => {
                    this.list = response.data.list;
                    this.page_list = response.data.page_list;
                    this.menu = response.data.menu;
                    this.load = true;
                });
            },
            Delete: function (item) {
                this.delete_item = item;
                UIkit.modal(this.delete_dialog).show();
            },
            Update: function (data) {
                this.list = data.list;
                this.page_list = data.page_list
            },
            deletePage: function (item) {
                this.$http.delete('/admin/present/delete/' + this.delete_item.id).then(response => {
                    UIkit.modal(this.delete_dialog).hide();
                    this.getList();
                });
            }
        },
    }
</script>
