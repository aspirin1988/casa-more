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
                                <input v-model="list.name" class="uk-input" id="name" type="text" placeholder="Название"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="description">Текст:</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-textarea" rows="5" id="description"
                                          v-model="list.description"></textarea>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label for="image" class="uk-form-label">Изображение:</label>
                            <div class="uk-form-controls">
                                <div class="uk-overflow-auto">
                                    <table class="uk-table">
                                        <thead>
                                        <tr>
                                            <th>Desktop</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="uk-my-file uk-cursor-pointer">
                                                    <label for=""
                                                           class="uk-label uk-display-block uk-text-center">desktop</label>
                                                    <img @click="imageGet('desktop',list.thumb)"
                                                         style="width: 90px; height: auto;"
                                                         v-if="list.thumb_image" :src="list.thumb_image" alt="">
                                                    <img @click="imageGet('desktop',list.thumb)"
                                                         style="width: 90px; height: auto;"
                                                         v-else="" :src="'/img/empty.png'" alt="">
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="pageSave" class="uk-button uk-button-success" type="button">Сохранить
                            </button>
                        </div>
                    </div>
                </header>
            </article>
        </div>
        <div id="modal-overflow" ref="modal-overflow" uk-modal>
            <div class="uk-modal-dialog">

                <button class="uk-modal-close-default" type="button" uk-close></button>

                <div class="uk-modal-header">
                    <h2 class="uk-modal-title">Галерея</h2>
                    <dir>
                        <ul class="uk-subnav uk-subnav-pill" uk-margin>
                            <li v-for="item in dir_list" :class="{'uk-active':item==current_dir}">
                                <a href="#" @click="setCurrentDir(item)">{{item}}</a>
                            </li>
                            <li class="uk-width-1-1">
                                <div>
                                    <div class="uk-inline">
                                        <a class="uk-form-icon" href="#" v-if="show_add_dir" @click="addDir()"
                                           title="Добавить директорию">
                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <rect x="9" y="1" width="1" height="17"></rect>
                                                <rect x="1" y="9" width="17" height="1"></rect>
                                            </svg>
                                        </a>
                                        <input :style="{textTransform:'none'}" type="text" class="uk-input"
                                               v-model="dir_name" v-if="show_add_dir">

                                        <a :style="{padding:'0 9px'}" class="uk-button uk-button-default" href="#"
                                           v-if="!show_add_dir" @click="showAddDir()"
                                           title="Добавить директорию">
                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <rect x="9" y="1" width="1" height="17"></rect>
                                                <rect x="1" y="9" width="17" height="1"></rect>
                                            </svg>
                                        </a>

                                        <a href="#" class="uk-form-icon uk-form-icon-flip" v-if="show_add_dir"
                                           @click="closeAddDir()" title="Отмена">
                                            <svg width="14" height="14" viewBox="0 0 14 14"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13"
                                                      y2="13"></line>
                                                <line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1"
                                                      y2="13"></line>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </dir>
                    <div class="js-upload uk-placeholder uk-text-center uk-position-relative">
                        <input :style="{opacity:0, zIndex: 1}" class="uk-height-1-1 uk-position-top-left uk-width-1-1"
                               type="file" multiple="multiple" @change="onUpload">
                        <span uk-icon="icon: cloud-upload"></span>
                        <span class="uk-text-middle">Перетащите файлы сюда или</span>
                        <div uk-form-custom>
                            <span class="uk-link">загрузите вручную</span>
                        </div>
                    </div>
                </div>

                <div class="uk-modal-body" uk-overflow-auto>
                    <div class="uk-child-width-1-3@m  uk-image-list" uk-grid="">
                        <div v-for="item in gallery_list">
                            <span class="uk-cursor-pointer" :class="{'uk-active':current_image == item}">
                                <img @click="SelectImage(item)" :src="item.image" alt="">
                                <span class="uk-label">{{getName(item.image)}}</span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Закрыть</button>
                    <button class="uk-button uk-button-primary" @click="setImage()" type="button">Применить</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {

                list: {},
                rules: {
                    name: 'required',
                    dir_list: 'image',
                    gallery_list: [],
                },

                image_list: [],
                gallery_list: [],
                dir_list: [],
                current_thumb: false,
                current_key: false,
                show_add_dir: false,
                current_dir: 'image',
                current_image: {},

            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            SelectImage: function (item) {
                this.current_image = item;
            },
            getName: function (name) {
                let arr = name.split('/');
                return arr[arr.length - 1];
            },
            onUpload: function (e) {
                let files = e.target.files;
                let formData = new FormData();

                formData.append('dir', this.current_dir);

                for (let i = 0; i < files.length; i++) {
                    formData.append('file[]', files[i]);
                }
                axios.post('/admin/image/upload',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    if (response.data.result) {
                        UIkit.notification({message: 'Изображения успешно загружены!', status: 'success'});
                        this.getGalleryList();
                    }
                })
                    .catch(function () {
                        UIkit.notification({message: 'При загрузки изображений произошла ошибка!', status: 'danger'});
                    });

            },

            closeAddDir: function () {
                this.show_add_dir = false;
                this.dir_name = '';
            },
            showAddDir: function () {
                this.show_add_dir = true;
            },
            addDir: function () {
                this.$http.post('/admin/image/add_dir', {'dir_name': this.dir_name}).then(response => {
                    this.dir_list = response.data.dir_list;
                    this.dir_name = '';
                    this.show_add_dir = false;
                });
            },
            setCurrentDir: function (item) {
                this.current_dir = item;
                this.getGalleryList();
            },
            imageGet: function (thumb, key) {
                this.current_thumb = thumb;
                this.current_key = key;
                this.getGalleryList();
                UIkit.modal(this.$refs['modal-overflow']).show();
            },
            getGalleryList: function () {
                this.$http.get('/admin/image/get_media/' + this.current_dir).then(response => {
                    let data = response.data;
                    this.gallery_list = data.images;
                    this.dir_list = data.dir_list;
                });
            },
            getData: function () {
                this.$http.get('/admin/brand/get/edit/' + this.id).then(response => {
                    this.list = response.data;
                });
            },
            pageSave: function () {
                if (this.$validator.run(this.list, this.rules)) {
                    this.$http.post('/admin/brand/save/' + this.id, this.list).then(response => {
                        UIkit.notification({message: 'Брэнд успешно обновлен!', status: 'success'});
                    });
                }
            },
            setImage: function () {
                this.list.thumb = this.current_image.id;
                this.list.thumb_image = this.current_image.image;
                // this.image_list[this.current_key]['data'][this.current_thumb] = this.current_image;
                this.pageSave();
                UIkit.modal(this.$refs['modal-overflow']).hide();
            },
        },
    }
</script>
