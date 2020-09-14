<template>
    <div class="Specifications" v-model="this.list.length > 0">
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
                <td class="name-field">Панель управления:</td>
                <td class="value-field" v-for="item in list">{{item.control_panel}}</td>
            </tr>
            <tr>
                <td class="name-field">Запоминание пользователя:</td>
                <td class="value-field" v-for="item in list">{{item.user_memorization}}</td>
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
                <td class="name-field">Тип управления:</td>
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
                <td class="name-field">Синхронизация с музыкой:</td>
                <td class="value-field" v-for="item in list">{{item.sync_with_music}}</td>
            </tr>
            <tr>
                <td class="name-field">Bluetooth:</td>
                <td class="value-field" v-for="item in list">{{item.bluetooth}}</td>
            </tr>
            <tr>
                <td class="name-field">Регулировка интенсивности массажа:</td>
                <td class="value-field" v-for="item in list">{{item.massage_intensity_adjustment}}</td>
            </tr>
            <tr>
                <td class="name-field">Регулировка скорости массажа:</td>
                <td class="value-field" v-for="item in list">{{item.massage_speed_adjustment}}</td>
            </tr>
            <tr>
                <td class="name-field">Ручное отключение:</td>
                <td class="value-field" v-for="item in list">{{item.manual_shutdown}}</td>
            </tr>
            <tr>
                <td class="name-field">Автоматическое отключение:</td>
                <td class="value-field" v-for="item in list">{{item.auto_shut_off}}</td>
            </tr>
            <tr>
                <td class="name-field">Антистресс система Braintronics:</td>
                <td class="value-field" v-for="item in list">{{item.antistress_system_braintronics}}</td>
            </tr>
            <tr>
                <td class="name-field">Число роликов в области спины:</td>
                <td class="value-field" v-for="item in list">{{item.number_rollers_back}}</td>
            </tr>
            <tr>
                <td class="name-field">Число роликов в области ступней:</td>
                <td class="value-field" v-for="item in list">{{item.number_rollers_foot}}</td>
            </tr>
            <tr>
                <td class="name-field">Общее число воздушных подушек:</td>
                <td class="value-field" v-for="item in list">{{item.number_airbags}}</td>
            </tr>
            <tr>
                <td class="name-field">Тип каретки:</td>
                <td class="value-field" v-for="item in list">{{item.carriage_type}}</td>
            </tr>
            <tr>
                <td class="name-field">Длина каретки:</td>
                <td class="value-field" v-for="item in list">{{item.carriage_length}}</td>
            </tr>
            <tr>
                <td class="name-field">Область массажа:</td>
                <td class="value-field" v-for="item in list">{{item.massage_area}}</td>
            </tr>
            <tr>
                <td class="name-field">Виды массажа:</td>
                <td class="value-field" v-for="item in list">{{item.type_massage}}</td>
            </tr>
            <tr>
                <td class="name-field">Максимальный вес пользователя:</td>
                <td class="value-field" v-for="item in list">{{item.maximum_user_weight}}</td>
            </tr>
            <tr>
                <td class="name-field">Угол наклона спинки:</td>
                <td class="value-field" v-for="item in list">{{item.backrest_angle}}</td>
            </tr>
            <tr>
                <td class="name-field">Угол наклона подножки:</td>
                <td class="value-field" v-for="item in list">{{item.footrest_tilt_angle}}</td>
            </tr>
            <tr>
                <td class="name-field">Минимальное расстояние от стены:</td>
                <td class="value-field" v-for="item in list">{{item.minimum_distance_wall}}</td>
            </tr>
            <tr>
                <td class="name-field">Основное напряжение:</td>
                <td class="value-field" v-for="item in list">{{item.main_voltage}}</td>
            </tr>
            <tr>
                <td class="name-field">Мощность:</td>
                <td class="value-field" v-for="item in list">{{item.power}}</td>
            </tr>
            <tr>
                <td class="name-field">Частота:</td>
                <td class="value-field" v-for="item in list">{{item.frequency}}</td>
            </tr>
            <tr>
                <td class="name-field">Габариты:</td>
                <td class="value-field" v-for="item in list">{{item.dimensions}}</td>
            </tr>
            <tr>
                <td class="name-field">Гарантия производителя:</td>
                <td class="value-field" v-for="item in list">{{item.manufacturer_warranty}}</td>
            </tr>
            <tr>
                <td class="name-field">Наличие:</td>
                <td class="value-field" v-for="item in list">{{item.available}}</td>
            </tr>

            <tr>
                <td class="name-field">Цена:</td>
                <td class="value-field" v-for="item in list">{{item.price}}</td>
            </tr>
            </tbody>
        </table>
        <div class="scroll-right" ></div>
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
            $('.scroll-right').click(function () {
                var pos = $('.Specifications').scrollLeft() + 50;
                $('.Specifications').scrollLeft(pos);
            });
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
                if (comparison) {
                    this.$http.get("/product-comparison/get/?ids=" + comparison.join(',')).then(response => {
                        // if (response.data.success) {
                        this.list = response.data.result;
                        // }
                    });
                } else {
                    this.$http.get("/product-comparison/get/all").then(response => {
                        this.list = response.data.result;
                    });
                }
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
<style>
    .scroll-right{
        position: fixed;
        background: #395569;
        width: 30px;
        height: 80%;
        right: calc((100% - 1125px)/2);
        top: 100px;
        cursor: pointer;
        background: #395569 url('/img/icon/2-layers-h.png') no-repeat center center;
        transform: rotate(180deg);
    }
    @media (max-width: 640px) {
        .scroll-right{
            display: none;
        }
    }
</style>
