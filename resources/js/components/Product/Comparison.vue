<template>
    <div class="Specifications" v-model="this.list.length">
        <div class="Specifications-title">Сравнение товаров</div>
        <table>
            <thead>
            <tr>
                <th class="name-field">&nbsp;</th>
                <th class="value-field" v-for="item in list">{{item.name}}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="name-field">Цвет:</td>
                <td class="value-field" v-for="item in list">
                    <span v-for="color in item.color" :class="classObject(color)"></span>
                </td>
            </tr>
            <tr>
                <td class="name-field">Вес:</td>
                <td class="value-field" v-for="item in list">
                    {{item.weight}}
                </td>
            </tr>
            <tr>
                <td class="name-field">Пульт дист. управления:</td>
                <td class="value-field" v-for="item in list">{{item.remote_controller}}</td>
            </tr>
            <tr>
                <td class="name-field">Система Zero-G:</td>
                <td class="value-field" v-for="item in list">{{item.zero_g}}</td>
            </tr>
            <tr>
                <td class="name-field">Таймер:</td>
                <td class="value-field" v-for="item in list">{{item.timer}}</td>
            </tr>
            <tr>
                <td class="name-field">Тип управления::</td>
                <td class="value-field" v-for="item in list">{{item.type_controller}}</td>
            </tr>
            <tr>
                <td class="name-field">Кол-во программ:</td>
                <td class="value-field" v-for="item in list">{{item.count_program}}</td>
            </tr>
            <tr>
                <td class="name-field">Прогрев:</td>
                <td class="value-field" v-for="item in list">{{item.warming_up}}</td>
            </tr>
            <tr>
                <td class="name-field">Область массажа:</td>
                <td class="value-field" v-for="item in list">{{item.massage_area}}</td>
            </tr>
            <tr>
                <td class="name-field">Наличие:</td>
                <td class="value-field" v-for="item in list">{{item.available}}</td>
            </tr>

            <tr>
                <td class="name-field">Цена:</td>
                <td class="value-field" v-for="item in list">{{item.price}}</td>
            </tr>
            <tr>
                <td class="name-field">&nbsp;</td>
                <td class="name-field" v-for="item in list" @click="Delete(item.id)"><span class="close"></span></td>
            </tr>

            </tbody>
        </table>
    </div>

</template>

<script>
    export default {
        props: ['brand'],
        data() {
            return {
                list: [],
            }
        },
        mounted() {
            this.getList();
        },
        methods: {
            Delete: function (id) {
                let comparison = JSON.parse(localStorage.getItem('comparison'));

                for (let i = 0; i < comparison.length; i++) {
                    if (id == comparison[i]) {
                        comparison.splice(i, 1);
                        localStorage.setItem('comparison', JSON.stringify(comparison));
                        this.getList();
                    }
                }

            },
            getList: function () {
                let comparison = JSON.parse(localStorage.getItem('comparison'));
                this.$http.get("/product-comparison/get/?ids=" + comparison.join(',')).then(response => {
                    console.log(response.data);
                    // if (response.data.success) {
                        this.list = response.data.result;
                    // }
                });
            },
            classObject: function (color) {
                let lg_icon = 'color-' + color;
                let data = {};
                data[lg_icon] = true;
                return data;
            }


        },
        computed: {},

    }
</script>
