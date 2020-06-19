<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Тэг</h2></div>
        </header>
        <div class="uk-margin">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class="uk-form-horizontal uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="name">Название:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.name" class="uk-input" id="name" type="text" placeholder="Название"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="keyword">Ключевое слово:</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="keyword" v-model="list.keyword">
                            </div>
                        </div>
                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="pageSave" class="uk-button uk-button-success" type="button">Сохранить
                            </button>
                        </div>
                    </div>
                </header>
            </article>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {
                list: {},
                rules: {
                    name: 'required',
                }
            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            getData: function () {
                this.$http.get('/admin/tag/get/edit/' + this.id).then(response => {
                    this.list = response.data;
                });
            },
            pageSave: function () {
                if (this.$validator.run(this.list, this.rules)) {
                    this.$http.post('/admin/tag/save/' + this.id, this.list).then(response => {
                        UIkit.notification({message: 'Тег успешно обновлен!', status: 'success'});
                    });
                }
            },
        },
    }
</script>
