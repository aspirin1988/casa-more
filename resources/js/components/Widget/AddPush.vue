<template>
	<div>
		<button class="uk-button uk-button-small uk-button-primary" @click="addQuestion">Добавить в пуш</button>
		<div id="push-dialog" ref="push-dialog" uk-modal>
			<div class="uk-modal-dialog uk-modal-body">
				<h2 class="uk-modal-title uk-text-warning">Предупреждение!</h2>
				<p> Вы действительно хотите добавить материал в PUSH ?</p>
				<p class="uk-text-right">
					<button class="uk-button uk-button-default uk-modal-close" type="button">Нет</button>
					<button class="uk-button uk-button-primary" @click="addPush" type="button">ДА!</button>
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
                push_dialog:false,
			}
        },
        mounted() {
            this.push_dialog = this.$refs['push-dialog'];
        },
        methods: {
            addQuestion: function () {
                UIkit.modal(this.push_dialog).show();
            },
            addPush: function () {
                UIkit.modal(this.push_dialog).hide();
                let data = {
                    object_id: this.id,
                    model: this.model,
                };
                this.$http.post('/admin/push/queue/add', data).then(response => {
                    let data = response.data;

                    if (data.result) {
                        UIkit.notification({message: data.message, status: 'success'});
                    } else {
                        UIkit.notification({message: data.message, status: 'danger'});
                    }
                });
            }
        }

    }
</script>