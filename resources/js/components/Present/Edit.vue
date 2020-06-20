<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Подарок</h2></div>
        </header>
        <div class="uk-margin">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class="uk-form-horizontal uk-margin-large">
                        <div v-if="list.parent_id" class="uk-margin">
                            <a :href="'/admin/present/edit/'+list.parent_id" class="uk-button uk-button-primary"
                               title="Вернутся к родительскому товару"><i uk-icon="reply"></i></a>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="name">Название:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.name" class="uk-input" id="name" type="text"
                                       placeholder="Название"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label for="brochure" class="uk-form-label">Изображение:</label>
                            <div class="uk-form-controls">
                                <input type="text" id="brochure"
                                       class="uk-input uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-2"
                                       placeholder="Изображение" v-model="list.image" autocomplete="off">
                                <div class="js-upload uk-placeholder uk-text-center uk-position-relative">
                                    <input :style="{opacity:0, zIndex: 1}"
                                           class="uk-height-1-1 uk-position-top-left uk-width-1-1"
                                           type="file" @change="onUploadBrochure">
                                    <span uk-icon="icon: cloud-upload"></span>
                                    <span class="uk-text-middle">Перетащите файлы сюда или</span>
                                    <div uk-form-custom>
                                        <span class="uk-link">загрузите вручную</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="description">Описание:</label>
                            <div class="uk-form-controls">
                                <textarea :id="'d1'" class="uk-textarea" rows="5" v-model="list.description"></textarea>
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
                list: {
                    brand: 0,
                },
                rules: {
                    name: 'required',
                },
                brand_list: [],
                tag_list: [],
                tags: [],
                tag_name: '',
                image_list: {},
                gallery_list: {},
                dir_list: [],
                current_image: {},
                child_list: {},
                new_child: {},
                current_thumb: '',
                current_dir: 'image',
                show_add_dir: false,
                create_image: false,
                dir_name: '',
                type_of_present_list: [],
            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            getName: function (name) {
                let arr = name.split('/');
                return arr[arr.length - 1];
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
                this.getGalleryListDir();
            },
            getData: function () {
                this.$http.get('/admin/present/get/edit/' + this.id).then(response => {
                    this.list = response.data.list;
                    this.image_list = response.data.image_list;
                    this.child_list = response.data.child_list;
                    this.type_of_present_list = response.data.type_of_present_list;
                });
            },
            getTags: function () {
                this.$http.get('/admin/present/get/tags/' + this.id).then(response => {
                    this.tags = response.data;
                });
            },
            pageSave: function () {
                if (this.$validator.run(this.list, this.rules)) {
                    this.$http.post('/admin/present/save/' + this.id, this.list).then(response => {
                        UIkit.notification({message: 'Продукт успешно обновлен!', status: 'success'});
                    });
                }
            },
            createImage: function () {
                this.getGalleryListDir();
                UIkit.modal(this.$refs['modal-overflow']).show();
                this.create_image = true;
            },
            imageGet: function (thumb) {
                this.current_thumb = thumb;
                this.getGalleryListDir();
                UIkit.modal(this.$refs['modal-overflow']).show();
            },
            findTag: function () {
                if (this.tag_name.length >= 2) {
                    this.$http.post('/admin/find/tag', {tag: this.tag_name}).then(response => {
                        if (response.data.length) {
                            this.tag_list = response.data;
                        } else {

                            this.tag_list = [];
                        }
                    });
                } else {
                    this.tag_list = [];
                }
            },
            addTag: function (item) {
                this.$http.post('/admin/present/set_tag', {present_id: this.id, tag: item}).then(response => {
                    let tag_list = response.data;
                    if (tag_list.message) {
                        UIkit.notification({message: tag_list.message, status: 'warning'});
                    } else {
                        UIkit.notification({message: "Тег успешно прикреплен!", status: 'success'});
                        this.getTags();
                    }
                });

                this.tag_name = '';
                this.tag_list = [];
            },
            removeTag: function (item) {
                let id = item.id;
                this.$http.delete('/admin/brand/unset_tag/' + id).then(response => {
                    UIkit.notification({message: "Тег успешно откреплен!", status: 'success'});
                    this.getTags();
                });
            },

            getChildList: function () {
                this.$http.get('/admin/present/get/child_list/' + this.id).then(response => {
                    this.child_list = response.data;
                });
            },
            AddChild: function () {
                this.new_child.parent_id = this.id;
                this.new_child.name = this.list.name;
                this.new_child.brand = this.list.brand;
                this.new_child.tags = this.tags;
                this.new_child.thumb_flower = this.list.thumb_flower;
                this.new_child.thumb_bottle = this.list.thumb_bottle;
                this.new_child.thumb_box = this.list.thumb_box;
                this.new_child.thumb_parallax_before = this.list.thumb_parallax_before;
                this.new_child.thumb_parallax_after = this.list.thumb_parallax_after;
                this.new_child.background = this.list.background;


                if (this.$validator.run(this.list, this.rules)) {
                    this.$http.put('/admin/present/add/', this.new_child).then(response => {
                        UIkit.notification({message: 'Продукт создан обновлен!', status: 'success'});
                        this.new_child = {};
                        this.getChildList();
                    });
                }
            },
            SaveChild: function (item) {
                if (this.$validator.run(item, this.rules)) {
                    this.$http.post('/admin/present/save/' + item.id, item).then(response => {
                        UIkit.notification({message: 'Продукт успешно обновлен!', status: 'success'});
                    });
                }
            },
            getGalleryList: function () {
                this.$http.get('/admin/present/get/images/' + this.id).then(response => {
                    let data = response.data;
                    this.image_list = data.images;
                });
            },

            getGalleryListDir: function () {
                this.$http.get('/admin/image/get_media/' + this.current_dir).then(response => {
                    let data = response.data;
                    this.gallery_list = data.images;
                    this.dir_list = data.dir_list;
                });
            },

            setImage: function () {
                if (!this.create_image) {
                    this.list[this.current_thumb] = this.current_image.id;
                    this.image_list[this.current_thumb] = this.current_image;
                    UIkit.modal(this.$refs['modal-overflow']).hide();
                    this.current_image = {};
                    this.current_thumb = '';
                } else {
                    let obj = this.current_image;
                    obj.object_id = this.id;
                    this.$http.post('/admin/image/clone', obj).then(response => {
                        UIkit.notification({message: "Изображение успешно создано!", status: 'success'});
                        this.getGalleryList();
                        UIkit.modal(this.$refs['modal-overflow']).hide();
                        this.current_image = {};
                        this.create_image = false;
                    });
                }
            },
            ClearThumb: function (item) {
                this.$http.delete('/admin/image/delete/' + item.id).then(response => {
                    UIkit.notification({message: "Изображение успешно уделено!", status: 'success'});
                    this.getGalleryList();
                });

            },
            SelectImage: function (item) {
                this.current_image = item;
            },
            onUpload: function (e) {
                let files = e.target.files;
                let formData = new FormData();

                formData.append('dir', this.current_dir);

                for (let i = 0; i < files.length; i++) {
                    formData.append('file[]', files[i]);
                }
                axios.post('/admin/image/upload/' + this.id,
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

            onUploadBrochure: function (e) {
                let files = e.target.files;
                let formData = new FormData();


                for (let i = 0; i < files.length; i++) {
                    formData.append('file[]', files[i]);
                }
                axios.post('/admin/present/image/upload/' + this.id,
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    if (response.data.result) {
                        UIkit.notification({message: 'Изображение успешно загружены!', status: 'success'});
                        this.list.image = response.data.result;
                    }
                })
                    .catch(function () {
                        UIkit.notification({message: 'При загрузки Изображения произошла ошибка!', status: 'danger'});
                    });

            },
        },
    }
</script>

<style>
    img {
        background: transparent;
    }

    .uk-my-fle {
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: background-color 0.5s;
    }

    .uk-my-fle:hover img {
        border-radius: 5px;
        background-color: rgba(15, 122, 229, 0.3);
    }
</style>
