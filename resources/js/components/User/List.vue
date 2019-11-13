<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Пользователи</h2></div>
            <widget-sub_menu-component :items="menu"></widget-sub_menu-component>
        </header>
        <div class="uk-margin-top">
            <article v-for="item in list" class="uk-comment uk-textarea uk-position-relative">
                <header class="uk-comment-header uk-news-grid">
                    <div class="uk-img-container uk-width-auto uk-position-relative uk-background-secondary">
                        <img class="uk-comment-avatar" :src="item.photo || '/img/item.first_name'" alt="">
                    </div>
                    <div>
                        <h4 class="uk-comment-title uk-margin-remove">
                            <span class="uk-link-reset">{{item.first_name +' '+ item.last_name}}</span>
                        </h4>
                        <ul class="uk-comment-meta uk-list uk-child-padding-remove">
                            <li>
                                <a class="uk-link-muted" href="#">
                                    ID:<strong>{{item.id}}</strong>
                                </a>
                            </li>
                            <li>
                                <a class="uk-link-muted" href="#">
                                    Login:<strong>{{item.email}}</strong>
                                </a>
                            </li>
                            <li>
                                <a class="uk-link-muted" href="#">
                                    Статус:<strong>{{item.status}}</strong>
                                </a>
                            </li>
                            <li>
                                <a class="uk-link-muted" href="#">
                                    <span>Отредактировано:</span>
                                    <strong>{{item.updated_at}}</strong>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="uk-comment-footer uk-padding-small">
                        <a class="uk-button uk-button-default uk-background-muted uk-button-secondary"
                           :href="'/admin/user/edit/'+item.id">
                            <span class="uk-text-success" uk-icon="file-edit"></span>
                        </a>
                        <button v-if="!item.hidden" @click="del(item)" title="Удалить пользователя"
                                class="uk-button uk-button-danger">
                            <span uk-icon="trash"></span>
                        </button>
                        <button v-if="item.is_admin" @click="setUser(item)" title="Разжаловать до пользователя"
                                class="uk-button uk-button-secondary">
                            <span uk-icon="lock"></span>
                        </button>
                        <button v-if="!item.is_admin" @click="setAdmin(item)" title="Повысить до `админа`"
                                class="uk-button uk-button-primary">
                            <span uk-icon="unlock"></span>
                        </button>
                    </div>
                </header>
                <div class="uk-comment-body">
                    <hr>
                    <p class="uk-padding-small uk-padding-remove-top" v-html="item.announce"></p>
                </div>
            </article>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['current_page', 'method'],
        data() {
            return {
                count: 0,
                list: {},
                menu: [
                    {id: 1, url: '/admin/user/all', text: "Все", alias: ['/admin/user/all']},
                    {id: 2, url: '/admin/user/buyers', text: "Покупатели", alias: ['/admin/user/buyers']},
                    {id: 3, url: '/admin/user/admins', text: "Админы", alias: ['/admin/user/admins']},
                ],

            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            getData: function () {
                this.$http.get('/admin/user/get/' + this.method + '/' + this.current_page).then(response => {
                    this.list = response.data.list;
                });
            },
            setUser: function (item) {
                this.$http.post('/admin/user/update/'+item.id,{is_admin:false}).then(response => {
                    item = response.data;

                });

            },
            setAdmin: function (item) {
                this.$http.post('/admin/user/update/'+item.id,{is_admin:true}).then(response => {
                    item = response.data;
                });

            },
        },
    }
</script>
