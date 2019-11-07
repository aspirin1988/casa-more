<template>
    <form onsubmit="return false;">
        <label>
            <span>Старый пароль:</span>
            <input type="password" v-model="obj.password" class="text">
        </label>
        <label>
            <span>Новый пароль:</span>
            <input type="password" v-model="obj.password_new" class="text">
        </label>
        <label>
            <span>Пароль <br>еще раз:</span>
            <input type="password" v-model="obj.password_new_c" class="text">
        </label>
        <button @click="Send" class="FormBtn">Сохранить</button>
    </form>

</template>

<script>
    export default {
        data() {
            return {
                obj: {},
            }
        },

        methods: {
            Send: function () {
                this.$http.post('/profile/reset_password', this.obj).then(
                    response => {
                        let data = response.data;
                        if (data.success) {
                            UIkit.notification({message: data.message, status: 'success'});
                            this.obj = {};
                        } else {
                            UIkit.notification({message: data.message, status: 'danger'});
                        }
                    },
                )
            }
        }
    }
</script>
