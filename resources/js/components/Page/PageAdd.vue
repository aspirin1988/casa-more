<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Страницы</h2></div>
        </header>
        <div class="uk-margin-top">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class="uk-form-horizontal uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">Название:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.title" class="uk-input" id="title" type="text"
                                       placeholder="Название" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="keyword">Ключевое слово:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.slug" class="uk-input" id="keyword" type="text"
                                       placeholder="Ключевое слово" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="text">Текст:*</label>
                            <div class="uk-form-controls">
                                <html-editor-component :id="'d1'" v-model="list.text"></html-editor-component>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="meta_keywords">Meta ключевые слова (keywords):</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-textarea" id="meta_keywords" v-model="list.keyword"></textarea>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="meta_description">Meta описание:</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-textarea" id="meta_description"
                                          v-model="list.description"></textarea>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="status">Сменить статус:</label>
                            <div class="uk-form-controls">
                                <select class="uk-select uk-width-1-2@m" v-model="list.status" id="status">
                                    <option>Не назначен</option>
                                    <option value="0">Повод</option>
                                    <option value="1">Опубликована</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="pageAdd" class="uk-button uk-button-success" type="button">Создать</button>
                        </div>
                    </div>
                </header>
            </article>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                list: {
                    status: 0,
                },
                rules: {
                    title: 'required',
                    slug: 'required',
                    text: 'required',
                }
            }
        },
        mounted() {
        },
        methods: {
            pageAdd: function () {
                if (this.$validator.run(this.list, this.rules)) {

                    this.$http.put('/admin/page/add/', this.list).then(response => {
                        let item = response.data;
                        if (item.id) {
                            UIkit.notification({message: 'Страница успешно создана!', status: 'success'});
                            setTimeout(() => {
                                location.href = '/admin/page/edit/' + item.id;
                            }, 500);
                        }
                    });
                }
            },
        },
    }
</script>
