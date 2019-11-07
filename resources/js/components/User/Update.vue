<template>
    <div class="uk-form" id="office-auth-login">
        <div class="uk-margin-small">
            <label for="email" class="uk-form-label">E-mail</label>
            <div class="uk-form-controls">
                <input type="text" name="email" placeholder=""
                       class="uk-input uk-form-width-medium"
                       id="email" v-model="list.email" disabled>
            </div>
        </div>
        <div class="uk-margin-small">
            <label for="name" class="uk-form-label">имя</label>
            <div class="uk-form-controls">
                <input type="text" name="name" placeholder="" class="uk-input uk-form-width-medium"
                       id="name" v-model="list.first_name">
            </div>
        </div>
        <div class="uk-margin-small">
            <label for="last_name" class="uk-form-label">фамилия</label>
            <div class="uk-form-controls">
                <input type="text" name="last_name" placeholder=""
                       class="uk-input uk-form-width-medium"
                       id="last_name"
                       v-model="list.last_name">
            </div>
        </div>
        <div class="uk-margin-small">
            <label for="day" class="uk-form-label">дата рождения</label>
            <div class="uk-form-controls">
                <div class="uk-button-group">
                    <input type="text" name="day" placeholder=""
                           class="uk-input uk-form-width-xsmall" @keyup="margeBirthday()"
                           id="day" v-model="day">
                    <input type="text" name="day" placeholder=""
                           class="uk-input uk-form-width-xsmall" @keyup="margeBirthday()"
                           id="month" v-model="month">
                    <input type="text" name="day" placeholder=""
                           class="uk-input uk-form-width-xsmall" @keyup="margeBirthday()"
                           id="year" v-model="year">
                </div>
            </div>
        </div>
        <div class="uk-margin-small">
            <label for="name" class="uk-form-label">пол</label>
            <div class="uk-form-controls">
                <select id="city" name="city" v-model="list.gender" class="uk-form-width-medium">
                    <option value="женский">женский</option>
                    <option value="мужской">мужской</option>
                </select>
            </div>
        </div>
        <div class="uk-margin-small">
            <label for="phone" class="uk-form-label">контактный номер</label>
            <div class="uk-form-controls">
                <input type="text" name="phone" placeholder="" v-model="list.phone"
                       class="uk-input uk-form-width-medium" id="phone">
            </div>
        </div>
        <div class="uk-margin-small">
            <button type="submit" class="uk-button uk-button-default uk-border-rounded" @click="save()">сохранить
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                count: 0,
                list: {},
                day: "01",
                month: "01",
                year: "2019",

            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            getData: function () {
                this.$http.get('/profile/get').then(response => {
                    this.list = response.data;
                    if (this.list.birthday) {
                        let date = this.list.birthday.split('-');
                        this.day = date[2];
                        this.month = date[1];
                        this.year = date[0];
                    }
                });
            },
            margeBirthday: function () {
                this.list.birthday = this.year + '-' + this.month + '-' + this.day;
            },
            save: function () {
                this.$http.post('/profile/update', this.list).then(response => {

                    console.log(this.list);

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
