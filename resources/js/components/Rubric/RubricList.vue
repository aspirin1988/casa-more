<template>
	<div>
		<header class="uk-content-header uk-background-default">
			<div class="title"><h2>Рубрики
				<div class="uk-inline">
					<button class="uk-button uk-button-primary uk-button-small uk-border-rounded" type="button" uk-icon="plus"></button>
					<div uk-dropdown>
						<ul class="uk-nav uk-nav-default" >
							<li class="">
								<a href="/admin/rubric/add" title="Страницу">
									<i uk-icon="template"></i><span>Рубрику</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</h2></div>
		</header>
		<div class="uk-margin-top">
			<div v-if="list.length">
			<widget-paginator-component :key="'upp'" :list="page_list" :current_page="current_page" :path="'/admin/rubric/'"></widget-paginator-component>
			<ul class="uk-comment-list">
				<li v-for="item in list">
					<rubric_list_item-component :item="item" :key="item.id" @Delete="Delete"></rubric_list_item-component>
				</li>
			</ul>
			<widget-paginator-component :key="'down'" :list="page_list" :current_page="current_page" :path="'/admin/rubric/'"></widget-paginator-component>
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
        props: ['current_page'],
        data() {
            return {
                list: [],
                page_list: null,
				load:false,
                delete_item: {},
                delete_dialog:false,
                path: window.location.pathname,
            }
        },
        mounted() {
            this.delete_dialog = this.$refs['delete-save'];

            this.getList();
        },
        methods: {
            getList:function () {
                this.$http.get('/admin/rubric/get/' + this.current_page).then(response => {
                    this.list = response.data.list;
                    this.page_list = response.data.page_list;
                    this.load = true;
                });
            },
            Delete: function (item) {
                this.delete_item = item;
                UIkit.modal(this.delete_dialog).show();
            },
            Update:function (data) {
                this.list = data.list;
                this.page_list = data.page_list
            },
			deletePage:function (item) {
                this.$http.delete('/admin/rubric/delete/' + this.delete_item.id).then(response => {
                    UIkit.modal(this.delete_dialog).hide();
                    this.getList();
                });
            }
		},
    }
</script>
