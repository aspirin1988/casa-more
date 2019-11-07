<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Страницы</h2></div>
            <p class="uk-custom-grid@s">
                <a :href="'/admin/page'" class="uk-button uk-button-small uk-button-default">
                    <span uk-icon="reply"></span>К списку "Страниц"
                </a>
                <a :href="'/admin/page/edit/'+id" class="uk-button uk-button-small uk-button-primary"><span
                        uk-icon="file-edit"></span>Редактировать</a>
            </p>
        </header>
        <div class="uk-margin-top">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class="uk-form-horizontal uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label">Уникальный номер:</label>
                            <div class="uk-form-controls">
                                <single-item-component :data="list.id"></single-item-component>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">Название:*</label>
                            <div class="uk-form-controls">
                                <single-item-component :data="list.title"></single-item-component>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="keyword">Ключевое слово:*</label>
                            <div class="uk-form-controls">
                                <single-item-component :data="list.keyword"></single-item-component>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="text">Текст:</label>
                            <div class="uk-form-controls" v-html="list.text"></div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="meta_title">Meta заголовок (Title):</label>
                            <div class="uk-form-controls">
                                <single-item-component :data="list.meta_title"></single-item-component>
                            </div>
                        </div>
                        <div class="uk-margin uk-margin-large-bottom">
                            <label class="uk-form-label" for="meta_keywords">Meta ключевые слова (keywords):</label>
                            <div class="uk-form-controls">
                                <single-item-component :data="list.meta_keywords"></single-item-component>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="meta_description">Meta описание:</label>
                            <div class="uk-form-controls">
                                <single-item-component :data="list.meta_description"></single-item-component>
                            </div>
                        </div>
                        <hr>
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
            axios.get('/admin/page/single/get/' + this.id).then(response => {
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
            Lock: function () {
                this.$http.get('/admin/page/lock/' + this.id).then(response => {
                });
            },
            UnLock: function () {
                this.$http.get('/admin/page/unlock/' + this.id).then(response => {
                });
            },
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