<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Товар
                    <div class="uk-inline">
                        <button class="uk-button uk-button-primary uk-button-small uk-border-rounded" type="button"
                                uk-icon="plus"></button>
                        <div uk-dropdown>
                            <ul class="uk-nav uk-nav-default">
                                <li class="">
                                    <a href="/admin/product/add" title="Брэнд">
                                        <i uk-icon="template"></i><span>Товар</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </h2>
            </div>
            <ul class="uk-filter" style="display: inline-flex; list-style: none;">
                <li><span class="uk-filter-heading">Сортировка:</span></li>
                <li>
                        <span class="uk-button uk-button-small uk-text-bold" :class="{'uk-active':sort==='name'}"
                              @click="setSortField('name')">
                            По названию
                            <span v-if="sort == 'name' && sort_method == 'desc'" uk-icon="triangle-up"></span>
                            <span v-if="sort == 'name' && sort_method =='asc'" uk-icon="triangle-down"></span>
                        </span>
                </li>
                <li>
                    <span class="uk-button uk-button-small uk-text-bold" :class="{'uk-active':sort==='created_at'}"
                          @click="setSortField('created_at')">
                        по дате
                        <span v-if="sort == 'created_at' && sort_method == 'desc'" uk-icon="triangle-up"></span>
                        <span v-if="sort == 'created_at' && sort_method =='asc'" uk-icon="triangle-down"></span>
                    </span>
                </li>
            </ul>
            <widget-sub_menu-component :items="menu" :rubric_id="rubric_id"></widget-sub_menu-component>
        </header>
        <div class="uk-margin-top">
            <div v-if="list.length">
                <widget-paginator-new-component @SetPage="setPage" :key="'down'" :list="page_list"
                                                :current_page="current_page"
                                                :path="'/admin/product/'"></widget-paginator-new-component>
                <ul class="uk-comment-list">
                    <li v-for="item in list">
                        <product_list_item-component :item="item" :key="item.id"
                                                     @Delete="Delete"></product_list_item-component>
                    </li>
                </ul>
                <widget-paginator-new-component @SetPage="setPage" :key="'down'" :list="page_list"
                                                :current_page="current_page"
                                                :path="'/admin/product/'"></widget-paginator-new-component>
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
                    // {id: 1, url: '/admin/product/massage_chairs', text: "Массажные кресла", alias: ['/admin/product/massage_chairs']},
                    // {id: 2, url: '/admin/product/massagers', text: "Массажеры", alias: ['/admin/product/massagers']},
                    // {id: 3, url: '/admin/product/fitness_equipment', text: "Фитнес оборудование", alias: ['/admin/product/fitness_equipment']},
                    // {id: 4, url: '/admin/product/household_products', text: "Товары для дома", alias: ['/admin/product/household_products']},
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

                this.$http.post('/admin/product/get/' + this.method, data).then(response => {
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
                this.$http.delete('/admin/product/delete/' + this.delete_item.id).then(response => {
                    UIkit.modal(this.delete_dialog).hide();
                    this.getList();
                });
            }
        },
    }
</script>
