<template>
    <div class="uk-form" id="password-reset">
        <div class="uk-margin-small">
            <label for="email" class="uk-form-label">E-mail</label>
            <div class="uk-form-controls">
                <input type="text" name="email" placeholder="" v-model="list.email"
                       class="uk-input uk-form-width-medium"
                       id="email" value="" disabled>
            </div>
        </div>
        <div class="uk-margin-small">
            <label for="password_old" class="uk-form-label">Старый пароль</label>
            <div class="uk-form-controls">
                <input type="password" name="password_old" placeholder=""
                       class="uk-input uk-form-width-medium"
                       id="password_old" value="" v-model="list.password">
            </div>
        </div>
        <div class="uk-margin-small">
            <label for="password_new" class="uk-form-label">Новый пароль</label>
            <div class="uk-form-controls">
                <div class="uk-inline">
                    <div class="uk-inline">
                        <span v-if="list.password_new && list.password_new == list.password_new_c && list.password_new.length > 3" class="uk-form-icon uk-form-icon-flip" uk-icon="icon: check"></span>
                        <input id="password_new" class="uk-input" type="password" v-model="list.password_new">
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-margin-small">
            <label for="password_new_c" class="uk-form-label">Подтверждение нового пароля</label>
            <div class="uk-form-controls">
                <div class="uk-inline">
                    <div class="uk-inline">
                        <span v-if="list.password_new_c && list.password_new == list.password_new_c && list.password_new_c.length > 3" class="uk-form-icon uk-form-icon-flip" uk-icon="icon: check"></span>
                        <input id="password_new_c" class="uk-input" type="password" v-model="list.password_new_c">
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-margin-small">
            <button type="submit" class="uk-button uk-button-default uk-border-rounded" @click="Reset()">сохранить</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                count: 0,
                list: {},

            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            getData: function () {
                this.$http.get('/profile/get').then(response => {
                    this.list = response.data;
                });
            },
            Reset: function () {
                this.$http.post('/profile/reset_password', this.list).then(response => {

                    let data = response.data;

                    if (data.success) {
                        UIkit.notification({message: data.message, status: 'success'});
                    } else {
                        UIkit.notification({message: data.message, status: 'danger'});
                    }


                });
            }
        },
    }
</script>
