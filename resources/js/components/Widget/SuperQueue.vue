<template>
	<div>
		<ul uk-accordion class="uk-padding-small uk-textarea uk-width-4-5@l">
			<li>
				<a class="uk-accordion-title" href="#">Добавить в семерку</a>
				<div class="uk-accordion-content">
					<ul class="tn-super-queue-grid">
						<li v-for="(item, index) in list" class="uk-inline">
							<div class="uk-height-small uk-position-relative uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light" :style="{backgroundImage:'url('+item.thumb+')'}" uk-img>
							</div>
							<div class="uk-overlay uk-overlay-primary uk-position-cover">
								<p v-if="item.publish_date" v-html="item.publish_date" title="Дата публикации" class="uk-label uk-label-success uk-margin-small"></p>
								<p v-html="item.title" class="uk-margin-remove-top uk-max-height@s">Default Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
								<div :class="{'uk-flex uk-flex-center':index===0}">
									<button :class="{'uk-width-1-1':index!==0 , 'uk-width-1-6@s':index===0 }" class="uk-button uk-button-small uk-button-danger" @click="addQuestion(item,'replace')">Заменить</button>
									<button :class="{'uk-width-1-1':index!==0 , 'uk-width-1-6@s':index===0 }" class="uk-button uk-button-small uk-button-secondary" @click="addQuestion(item,'shift')">Сдвинуть</button>
								</div>
								<div class="uk-flex uk-flex-center uk-margin-small-top uk-width-1-1">
									<button class="uk-button uk-button-small uk-button-primary" @click="Sort('up',item)" uk-icon="arrow-up"></button>
									<button class="uk-button uk-button-small uk-button-primary" @click="Sort('down',item)" uk-icon="arrow-down"></button>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</li>
		</ul>
		<div id="push-dialog" ref="push-dialog" uk-modal>
			<div class="uk-modal-dialog uk-modal-body">
				<h2 class="uk-modal-title uk-text-warning">Предупреждение!</h2>
				<p> Вы действительно хотите добавить материал в "Семёрку" ?</p>
				<p class="uk-text-right">
					<button class="uk-button uk-button-default uk-modal-close" type="button">Нет</button>
					<button class="uk-button uk-button-primary" @click="addToQueue" type="button">ДА!</button>
				</p>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        props: ['model', 'id'],
        data() {
            return {
                list: [],
                push_dialog: false,
                item: {},
                method: '',
            }
        },
        mounted() {
            this.push_dialog = this.$refs['push-dialog'];
            this.getList();
        },
        methods: {
            Sort: function (method, item) {
                this.$http.get('/admin/super/queue/' + method + '/' + item.pos).then(response => {
                    let data = response.data;
                    if (data.result) {
                        UIkit.notification({message: data.message, status: 'success'});
                        this.getList();
                    } else {
                        UIkit.notification({message: data.message, status: 'danger'});
                    }
                });
            },
            addToQueue: function () {
                let data = {
                    pos: this.item.pos,
                    object_type: this.model,
                    object_id: this.id,
                    method: this.method,
                };
                this.$http.post('/admin/super/queue/add', data).then(response => {
                    let data = response.data;
                    if (data.result) {
                        UIkit.notification({message: data.message, status: 'success'});
                        this.getList();
                    } else {
                        UIkit.notification({message: data.message, status: 'danger'});
                    }
                    UIkit.modal(this.push_dialog).hide();
                });
            },
            getList: function () {
                this.$http.get('/admin/super/queue/get').then(response => {
                    this.list = [];
                    this.list = response.data;
                });
            },
            addQuestion: function (item, method) {
                this.item = item;
                this.method = method;
                UIkit.modal(this.push_dialog).show();
            },
        }

    }
</script>

<style>
	.uk-height-small{
		height: 220px;
	}

	.uk-max-height{
		overflow: hidden;
	}
	.uk-max-height\@s{
		max-height: 50px;
	}
</style>