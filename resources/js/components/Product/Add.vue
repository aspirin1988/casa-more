<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Продукт</h2></div>
        </header>
        <div class="uk-margin">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class="uk-form-horizontal uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="brand">Тип товара*:</label>
                            <div class="uk-form-controls">
                                <select class="uk-select uk-width-1-2@m" id="brand" v-model="list.type_of_product">
                                    <option value="0">Не назначен</option>
                                    <option value="household_products">Товары для дома</option>
                                    <option value="massage_chairs">Массажные кресла</option>
                                    <option value="Massagers_for_legs">Массажеры для ног</option>
                                    <option value="Massage_wraps">Массажные накидки</option>
                                    <option value="Massage_pillows">Массажные подушки</option>
                                    <option value="Massagers">Массажеры</option>
                                    <option value="fitness_equipment">Фитнес оборудование</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="name">Название:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.name" class="uk-input" id="name" type="text" placeholder="Название"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="color">Цвет*:</label>
                            <div class="uk-form-controls">
                                <select class="uk-select uk-width-1-2@m" id="color" v-model="list.color">
                                    <option value="0">Не назначен</option>
                                    <option value="white">Белый</option>
                                    <option value="cream">Кремовый</option>
                                    <option value="graphite">Графит</option>
                                    <option value="brown">Коричневый</option>
                                    <option value="orange">Оранжевый</option>
                                    <option value="gray">Серый</option>
                                    <option value="red">Серый</option>
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
                    brand: 0,
                },
                rules: {
                    name: 'required',
                },
                brand_list: [],
                tag_list: [],
                tag_name: '',
            }
        },
        mounted() {
            this.getBrands();
        },
        methods: {
            getBrands: function () {
                this.$http.get('/admin/brand/get/all').then(response => {
                    this.brand_list = response.data.list;
                });
            },
            pageAdd: function () {
                if (this.$validator.run(this.list, this.rules)) {
                    this.$http.put('/admin/product/add/', this.list).then(response => {
                        let item = response.data;
                        if (item.id) {
                            UIkit.notification({message: 'Товара успешно создан!', status: 'success'});
                            setTimeout(() => {
                                location.href = '/admin/product/edit/' + item.id;
                            }, 500);
                        }
                    });
                }
            },

            findTag: function () {
                if (this.tag_name.length >= 2) {
                    this.$http.post('/admin/find/tag', {tag: this.tag_name}).then(response => {
                        if (response.data.length) {
                            this.tag_list = response.data;
                        } else {

                            this.tag_list = [{tag: this.tag_name, _new: true}];
                        }
                    });
                } else {
                    this.tag_list = [];
                }
            },
            addTag: function (item) {
                let tag_id = item.id;
                this.$http.post('/admin/product/set_tag', {product_id: this.id, tag_id: tag_id}).then(response => {
                    let tag_list = response.data;
                    if (tag_list.message) {
                        UIkit.notification({message: tag_list.message, status: 'warning'});
                    } else {
                        this.list.tags = tag_list;
                        UIkit.notification({message: "Тег успешно прикреплен к товарау!", status: 'success'});
                    }
                });

                this.tag_name = '';
                this.tag_list = [];
            },
            removeTag: function (item) {
                let id = item.id;
                this.$http.delete('/admin/brand/unset_tag/' + id).then(response => {
                    this.list.tags = response.data;
                    UIkit.notification({message: "Тег успешно откреплен от товара!", status: 'success'});
                });
            },
        },
    }
</script>
