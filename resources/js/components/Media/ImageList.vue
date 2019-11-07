<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Изображения ({{dir}})</h2>
            </div>
        </header>
        <div class="uk-margin-top">
            <div v-if="list.length">
                <widget-paginator-component :key="'upp'" :list="page_list" :current_page="current_page"
                                            :path="'/admin/brand/'"></widget-paginator-component>
                <ul class="media-grid">
                    <li v-for="item in list">
                        <image_list_item-component :item="item" :key="item.id"
                                                   @Delete="Delete"></image_list_item-component>
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
                <p> Вы действительно хотите удалить изображение?</p>
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
        props: ['dir'],
        data() {
            return {
                list: [],
                page_list: null,
                load: false,
                delete_item: {},
                delete_dialog: false,
                path: window.location.pathname,
            }
        },
        mounted() {
            this.delete_dialog = this.$refs['delete-save'];

            this.getList();
        },
        methods: {
            getList: function () {
                this.$http.get('/admin/media_list/get/' + this.dir).then(response => {
                    this.list = response.data.list;
                    this.page_list = response.data.page_list;
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
                this.$http.delete('/admin/image/delete/' + this.delete_item.id).then(response => {
                    UIkit.modal(this.delete_dialog).hide();
                    this.getList();
                });
            }
        },
    }
</script>
<style>
    .media-grid{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        list-style: none;
        grid-gap: 20px;
    }
    @media (max-width: 640px) {
        .media-grid{
            grid-template-columns: 1fr;
        }
    }
</style>