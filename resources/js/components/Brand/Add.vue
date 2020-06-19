<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Брэнд</h2></div>
        </header>
        <div class="uk-margin">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class="uk-form-horizontal uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="name">Название:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.name" class="uk-input" id="name" type="text" placeholder="Название" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="description">Текст:</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-textarea" rows="5" id="description" v-model="list.description"></textarea>
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
                list: {},
                rules: {
                    name: 'required',
                }
            }
        },
        mounted() {},
        methods: {
            pageAdd: function () {
                if (this.$validator.run(this.list, this.rules)) {
                    this.$http.put('/admin/brand/add/', this.list).then(response => {
                        let item  = response.data;
                        if(item.id) {
                            UIkit.notification({message: 'Брэнд успешно создан!', status: 'success'});
                            setTimeout(() => {
                                location.href = '/admin/brand/edit/'+item.id;
                            }, 500);
                        }
                    });
                }
            },
        },
    }
</script>
