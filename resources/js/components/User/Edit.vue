<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Пользыватель</h2></div>
        </header>
        <div class="uk-margin">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class="uk-form-horizontal uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="first_name">Имя:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.first_name" class="uk-input" id="first_name" type="text" placeholder="Имя"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="last_name">Фамилия:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.last_name" class="uk-input" id="last_name" type="text" placeholder="Фамилия"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="phone">Телефон:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.phone" class="uk-input" id="phone" type="text" placeholder="Телефон"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="birthday">дата рождения:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.birthday" class="uk-input" id="birthday" type="date" placeholder="дата рождения"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="gender">пол:</label>
                            <div class="uk-form-controls">
                                <select id="gender" v-model="list.gender" name="gender" class="uk-form-width-medium">
                                    <option value="женский">женский</option>
                                    <option value="мужской">мужской</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="pageAdd" class="uk-button uk-button-success" type="button">Сохранить</button>
                        </div>
                    </div>
                </header>
            </article>
        </div>
    </div>
</template>

<script>
    export default {
        props:['id'],
        data() {
            return {
                list: {},
                brand_list: [],
                tag_list: [],
                tag_name: '',
            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            getData: function () {
                    this.$http.get('/admin/user/get/edit/'+this.id, this.list).then(response => {
                        this.list = response.data;
                    });
            },
            pageAdd: function () {
                    this.$http.post('/admin/user/update/'+this.id, this.list).then(response => {
                        let item = response.data;
                        if (item.id) {
                            UIkit.notification({message: 'Пользователь успешно обновлен!', status: 'success'});
                        }
                    });
            },

        },
    }
</script>
