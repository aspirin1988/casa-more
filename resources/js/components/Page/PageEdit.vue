<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Страницы</h2></div>
        </header>
        <div class="uk-margin-top">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class="uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">Название:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.title" class="uk-input" id="title" type="text"
                                       placeholder="Название" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="news">Новость:</label>
                            <div class="uk-inline">
                                <div class="onoffswitch-small">
                                    <input type="checkbox" class="onoffswitch-checkbox" id="news"
                                           v-model="list.news">
                                    <label class="onoffswitch-label" for="news"></label>
                                </div>
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
                            <label class="uk-form-label" for="text">Текст:</label>
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
                            <button @click="pageSave(false)" class="uk-button uk-button-success" type="button">
                                Сохранить
                            </button>
                            <a :href="'/admin/page/'" class="uk-button uk-button-danger" type="button">Отмена</a>
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
            }
        },
        mounted() {
            axios.get('/admin/page/get/edit/' + this.id).then(response => {
                this.list = response.data;
            });
        },
        created() {
            this.interval = setInterval(() => {
                this.Lock();
            }, 1000 * 90);

            let _that = this;

            window.onbeforeunload = () => {
                clearInterval(_that.interval);
                _that.UnLock();
            }
        },
        methods: {
            pageSave: function (exit) {
                axios.post('/admin/page/save/' + this.id, this.list).then(response => {
                    UIkit.notification({message: 'Страница успешно сохранена!', status: 'success'});
                    if (exit) {
                        setTimeout(() => {
                            location.href = '/admin/page/';
                        }, 500);
                    }
                });
            },
        },
    }
</script>
