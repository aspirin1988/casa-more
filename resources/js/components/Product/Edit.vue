<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Продукт</h2></div>
            <a :href="list.url" target="_blank">Просмотреть на сайте</a>
            <span v-html="list.url"></span>
        </header>
        <div class="uk-margin">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class="uk-form-horizontal uk-margin-large">
                        <div v-if="list.parent_id" class="uk-margin">
                            <a :href="'/admin/product/edit/'+list.parent_id" class="uk-button uk-button-primary"
                               title="Вернутся к родительскому товару"><i uk-icon="reply"></i></a>
                        </div>
                        <div v-if="list.parent_id" class="uk-margin">
                            <span @click="Delete()" class="uk-button uk-button-danger"
                                  title="Удалить"><i uk-icon="trash"></i></span>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="type_of_product">Тип товара*:</label>
                            <div class="uk-form-controls">
                                <select class="uk-select uk-width-1-2@m" id="type_of_product"
                                        v-model="list.type_of_product">
                                    <option value="0">Не назначен</option>
                                    <option v-for="item in type_of_product_list" :value="item.slug">{{item.name}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin"
                             v-if="list.type_of_product=='fitness_equipment' || list.type_of_product=='household_products'">
                            <label class="uk-form-label" for="sub_type_of_product">Доп тип товара*:</label>
                            <div class="uk-form-controls">
                                <select v-if="list.type_of_product=='fitness_equipment'"
                                        class="uk-select uk-width-1-2@m" id="sub_type_of_product"
                                        v-model="list.sub_type_of_product">
                                    <option value="">Не назначен</option>
                                    <option value="treadmills">Беговые дорожки</option>
                                    <option value="vibration_platforms">виброплатформы</option>
                                    <option value="exercise_bikes">велотренажеры</option>
                                    <option value="expanders">эспандеры</option>
                                    <option value="massage_mats">массажные коврики</option>
                                    <option value="dumbbells">гантели</option>
                                </select>
                                <select v-if="list.type_of_product=='household_products'"
                                        class="uk-select uk-width-1-2@m" id="sub_type_of_product"
                                        v-model="list.sub_type_of_product">
                                    <option value="">Не назначен</option>
                                    <option value="candles">Свечи</option>
                                    <option value="soap">Мыло</option>
                                    <option value="perfume for home">Парфюм для дома</option>
                                    <option value="bath bombs">Бомбы для ванн</option>
                                </select>
                            </div>
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
                            <label class="uk-form-label" for="price">Цена:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.price" class="uk-input" id="price" type="number"
                                       placeholder="Цена"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="price">Цена со скидкой:</label>
                            <div class="uk-form-controls">
                                <input :value="list.price-((list.price/100)*list.discount)" class="uk-input"
                                       id="price"
                                       type="number" placeholder="Цена"
                                       autocomplete="off" disabled="disabled">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="discount">Скидка в %:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.discount" class="uk-input" id="discount" type="number"
                                       placeholder="Скидка в %"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="present">Описание подарка:</label>
                            <div class="uk-form-controls">
                                    <textarea rows="10" class="uk-textarea" v-model="list.present"
                                              id="present"></textarea>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="type_of_product">Подарок:</label>
                            <div class="uk-form-controls">
                                <select class="uk-select uk-width-1-2@m" id="type_of_product"
                                        v-model="list.present">
                                    <option value="0">Не назначен</option>
                                    <option v-for="item in present_list" :value="item.id">{{item.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="available">В наличии:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.available" class="uk-checkbox" id="available"
                                       type="checkbox" placeholder="В наличии"
                                       autocomplete="off">
                            </div>
                        </div>

                        <div v-if="list.type_of_product == 'massage_chairs'">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="brand">Брэнд*:</label>
                                <div class="uk-form-controls">
                                    <select class="uk-select uk-width-1-2@m" id="brand" v-model="list.brand">
                                        <option value="0">Не назначен</option>
                                        <option v-for="item in brand_list" :value="item.id">{{item.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="name">Область массажа:*</label>
                                <div class="uk-form-controls">
                                    <input v-model="list.massage_area" class="uk-input" id="massage_area" type="text"
                                           placeholder="Область массажа"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="color">Цвет*:</label>
                                <div class="uk-form-controls">
                                    <select class="uk-select uk-width-1-2@m" id="color" v-model="list.color">
                                        <option value="0">Не назначен</option>
                                        <option value="red">Красный</option>
                                        <option value="white">Белый</option>
                                        <option value="cream">Кремовый</option>
                                        <option value="graphite">Графит</option>
                                        <option value="brown">Коричневый</option>
                                        <option value="orange">Оранжевый</option>
                                        <option value="gray">Серый</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="type_controller">Тип управления*:</label>
                                <div class="uk-form-controls">
                                    <select class="uk-select uk-width-1-2@m" id="type_controller"
                                            v-model="list.type_controller">
                                        <option value="0">Не назначен</option>
                                        <option value="automatic">Автоматическое</option>
                                        <option value="manual">Ручное</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="weight">Вес:*</label>
                                <div class="uk-form-controls">
                                    <input v-model="list.weight" class="uk-input" id="weight" type="number"
                                           placeholder="Вес" autocomplete="off">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="count_program">Количество программ:*</label>
                                <div class="uk-form-controls">
                                    <input v-model="list.count_program" class="uk-input" id="count_program"
                                           type="number"
                                           placeholder="Объем" autocomplete="off">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="remote_controller">Пульт управления:</label>
                                <div class="uk-form-controls">
                                    <input v-model="list.remote_controller" class="uk-checkbox" id="remote_controller"
                                           type="checkbox" placeholder="Пульт управления"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="zero_g">Zero-G:</label>
                                <div class="uk-form-controls">
                                    <input v-model="list.zero_g" class="uk-checkbox" id="zero_g"
                                           type="checkbox" placeholder="Zero-G"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="timer">Таймер:</label>
                                <div class="uk-form-controls">
                                    <input v-model="list.timer" class="uk-checkbox" id="timer"
                                           type="checkbox" placeholder="Таймер"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="timer">Прогрев:</label>
                                <div class="uk-form-controls">
                                    <input v-model="list.warming_up" class="uk-checkbox" id="warming_up"
                                           type="checkbox" placeholder="Прогрев"
                                           autocomplete="off">
                                </div>
                            </div>
                        </div>
<!--                        <div>-->
<!--                            <div class="uk-margin">-->
<!--                                <label class="uk-form-label" for="brand">Брэнд*:</label>-->
<!--                                <div class="uk-form-controls">-->
<!--                                    <select class="uk-select uk-width-1-2@m" id="brand" v-model="list.brand">-->
<!--                                        <option value="0">Не назначен</option>-->
<!--                                        <option v-for="item in brand_list" :value="item.id">{{item.name}}</option>-->
<!--                                    </select>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="uk-margin">-->
<!--                                <label class="uk-form-label" for="name">Область массажа:*</label>-->
<!--                                <div class="uk-form-controls">-->
<!--                                    <input v-model="list.massage_area" class="uk-input" id="massage_area" type="text"-->
<!--                                           placeholder="Область массажа"-->
<!--                                           autocomplete="off">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="uk-margin">-->
<!--                                <label class="uk-form-label" for="color">Цвет*:</label>-->
<!--                                <div class="uk-form-controls">-->
<!--                                    <select class="uk-select uk-width-1-2@m" id="color" v-model="list.color">-->
<!--                                        <option value="0">Не назначен</option>-->
<!--                                        <option value="red">Красный</option>-->
<!--                                        <option value="white">Белый</option>-->
<!--                                        <option value="cream">Кремовый</option>-->
<!--                                        <option value="graphite">Графит</option>-->
<!--                                        <option value="brown">Коричневый</option>-->
<!--                                        <option value="orange">Оранжевый</option>-->
<!--                                        <option value="gray">Серый</option>-->
<!--                                    </select>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="uk-margin">-->
<!--                                <label class="uk-form-label" for="type_controller">Тип управления*:</label>-->
<!--                                <div class="uk-form-controls">-->
<!--                                    <select class="uk-select uk-width-1-2@m" id="type_controller"-->
<!--                                            v-model="list.type_controller">-->
<!--                                        <option value="0">Не назначен</option>-->
<!--                                        <option value="automatic">Автоматическое</option>-->
<!--                                        <option value="manual">Ручное</option>-->
<!--                                    </select>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="uk-margin">-->
<!--                                <label class="uk-form-label" for="count_program">Количество программ:*</label>-->
<!--                                <div class="uk-form-controls">-->
<!--                                    <input v-model="list.count_program" class="uk-input" id="count_program"-->
<!--                                           type="number"-->
<!--                                           placeholder="Объем" autocomplete="off">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="uk-margin">-->
<!--                                <label class="uk-form-label" for="remote_controller">Пульт управления:</label>-->
<!--                                <div class="uk-form-controls">-->
<!--                                    <input v-model="list.remote_controller" class="uk-checkbox" id="remote_controller"-->
<!--                                           type="checkbox" placeholder="Пульт управления"-->
<!--                                           autocomplete="off">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="uk-margin">-->
<!--                                <label class="uk-form-label" for="timer">Прогрев:</label>-->
<!--                                <div class="uk-form-controls">-->
<!--                                    <input v-model="list.warming_up" class="uk-checkbox" id="warming_up"-->
<!--                                           type="checkbox" placeholder="Прогрев"-->
<!--                                           autocomplete="off">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div v-if="list.type_of_product == 'fitness_equipment'">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="brand">Брэнд*:</label>
                                <div class="uk-form-controls">
                                    <select class="uk-select uk-width-1-2@m" id="brand" v-model="list.brand">
                                        <option value="0">Не назначен</option>
                                        <option v-for="item in brand_list" :value="item.id">{{item.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="type_controller">Тип управления*:</label>
                                <div class="uk-form-controls">
                                    <select class="uk-select uk-width-1-2@m" id="type_controller"
                                            v-model="list.type_controller">
                                        <option value="0">Не назначен</option>
                                        <option value="automatic">Автоматическое</option>
                                        <option value="manual">Ручное</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="remote_controller">Пульт управления:</label>
                                <div class="uk-form-controls">
                                    <input v-model="list.remote_controller" class="uk-checkbox" id="remote_controller"
                                           type="checkbox" placeholder="Пульт управления"
                                           autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label for="tag" class="uk-form-label">Тэги:</label>
                            <div class="uk-form-controls">
                                <input type="text" id="tag"
                                       class="uk-input uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-2"
                                       placeholder="Тэги" v-model="tag_name" @keyup="findTag" autocomplete="off">
                                <ul class="uk-list uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-2">
                                    <li v-for="item in tag_list">
                                        <a class="uk-button uk-button-primary uk-width-1-2">{{item.name}}</a>
                                        <button type="button" class="uk-button uk-button-success"
                                                @click="addTag(item)">
                                            <i uk-icon="plus"></i>
                                        </button>
                                    </li>
                                </ul>
                                <div class="uk-margin-top uk-margin-bottom" id="tag_list">
                                    <div v-for="item in tags"
                                         class="uk-badge uk-margin-small-right uk-margin-small-bottom">
                                        {{item.data.name}}
                                        <a uk-icon="close"
                                           class="uk-button-danger uk-border-rounded uk-margin-small-left"
                                           @click="removeTag(item)"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label for="brochure" class="uk-form-label">Брошюра:</label>
                            <div class="uk-form-controls">
                                <input type="text" id="brochure"
                                       class="uk-input uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-2"
                                       placeholder="Брошюра" v-model="list.brochure" autocomplete="off">
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
                                <html-editor-component :id="'d1'"
                                                       v-model="list.description"></html-editor-component>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="custom_style">Custom style:</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-textarea" rows="10" id="custom_style" v-model="list.custom_style"></textarea>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label for="images" class="uk-form-label">Изображение для каталога:</label>
                            <div class="uk-form-controls">
                                <div class="uk-my-fle uk-cursor-pointer">
                                    <div v-if="image_list.background" class="uk-position-relative">
                                        <img @click="imageGet('background')"
                                             style="width: 90px; height: auto;" v-if="image_list.background"
                                             :src="image_list.background.image" alt="">
                                        <a uk-icon="close" @click="ClearThumb('background')"
                                           class="uk-button-danger uk-border-rounded uk-margin-remove uk-icon uk-position-top-right"></a>
                                    </div>
                                    <img @click="imageGet('background')"
                                         style="width: 90px; height: auto;" v-else=""
                                         :src="'/img/empty.png'" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label for="images" class="uk-form-label">Изображения:
                                <button @click="createImage" class="uk-button-primary uk-button-small uk-border-rounded"
                                        uk-icon="plus"></button>
                            </label>
                            <div class="uk-form-controls">
                                <div class="js-upload uk-placeholder uk-text-center uk-position-relative">
                                    <input :style="{opacity:0, zIndex: 1}"
                                           class="uk-height-1-1 uk-position-top-left uk-width-1-1"
                                           type="file" multiple="multiple" @change="onUpload">
                                    <span uk-icon="icon: cloud-upload"></span>
                                    <span class="uk-text-middle">Перетащите файлы сюда или</span>
                                    <div uk-form-custom>
                                        <span class="uk-link">загрузите вручную</span>
                                    </div>
                                </div>
                                <div class="uk-child-width-1-3@s" uk-grid="">
                                    <div class="uk-my-fle uk-cursor-pointer" v-for="(item,key) in image_list">
                                        <div v-if="key !== 'background' " class="uk-position-relative">
                                            <img style="width: 90px; height: auto;"
                                                 :src="item.image" alt="">
                                            <a uk-icon="close" @click="ClearThumb(item)"
                                               class="uk-button-danger uk-border-rounded uk-margin-remove uk-icon uk-position-top-right"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
<!--                        <div class="uk-margin">-->
<!--                            <label for="icons" class="uk-form-label">Иконки:-->
<!--                                <button @click="createIcon" class="uk-button-primary uk-button-small uk-border-rounded"-->
<!--                                        uk-icon="plus"></button>-->
<!--                            </label>-->
<!--                            <div class="uk-form-controls">-->
<!--                                <div class="uk-child-width-1-3@s" uk-grid="">-->
<!--                                    <div class="uk-my-fle uk-cursor-pointer" v-for="(item,key) in list.icons">-->
<!--                                        <div class="uk-position-relative">-->
<!--                                            <img style="width: 90px; height: auto;" :src="item" alt="">-->
<!--                                            <a uk-icon="close" @click="ClearIcon(key)"-->
<!--                                               class="uk-button-danger uk-border-rounded uk-margin-remove uk-icon uk-position-top-right"></a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <br>
                        <br>
                        <hr>
                        <div v-if="!list.parent_id" class="uk-margin">
                            <label class="uk-form-label" for="status">Добавить дополнительный товар</label>
                            <div class="uk-form-controls">
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="new_color">Цвет*:</label>
                                    <div class="uk-form-controls">
                                        <select class="uk-select uk-width-1-2@m" id="new_color"
                                                v-model="new_child.color">
                                            <option value="0">Не назначен</option>
                                            <option value="red">Красный</option>
                                            <option value="white">Белый</option>
                                            <option value="cream">Кремовый</option>
                                            <option value="graphite">Графит</option>
                                            <option value="brown">Коричневый</option>
                                            <option value="orange">Оранжевый</option>
                                            <option value="gray">Серый</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <button @click="AddChild" type="button" uk-icon="plus"
                                            class="uk-button uk-button-primary uk-button-small uk-border-rounded uk-icon"
                                            aria-expanded="false">
                                    </button>
                                </div>
                            </div>
                            <ul uk-accordion>
                                <li>
                                    <a class="uk-accordion-title" href="#">Дополнительный товар</a>
                                    <div class="uk-accordion-content">
                                        <div class="uk-form-controls">
                                            <div v-for=" item in child_list">
                                                <div>
                                                    <a :href="'/admin/product/edit/'+item.id"
                                                       class="uk-button uk-button-default uk-background-muted uk-button-secondary"
                                                       title="Редактировать дочерний товар">
                                                        <span uk-icon="file-edit"
                                                              class="uk-text-success uk-icon"></span>
                                                    </a>
                                                </div>
                                                <div class="uk-margin">
                                                    <label class="uk-form-label"
                                                           :for="'color_'+item.id">Цвет:*</label>
                                                    <div class="uk-form-controls">
                                                        <select class="uk-select uk-width-1-2@m" :id="'volume_'+item.id"
                                                                v-model="item.color">
                                                            <option value="0">Не назначен</option>
                                                            <option value="red">Красный</option>
                                                            <option value="white">Белый</option>
                                                            <option value="cream">Кремовый</option>
                                                            <option value="graphite">Графит</option>
                                                            <option value="brown">Коричневый</option>
                                                            <option value="orange">Оранжевый</option>
                                                            <option value="gray">Серый</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <hr>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="status">Сменить статус:</label>
                            <div class="uk-form-controls">
                                <select class="uk-select uk-width-1-2@m" v-model="list.status" id="status">
                                    <option>Не назначен</option>
                                    <option value="0">Не опубликована</option>
                                    <option value="1">Опубликована</option>
                                </select>
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
                    <div>
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
                    </div>
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
                <div id="delete-save" ref="delete-save" uk-modal>
                    <div class="uk-modal-dialog uk-modal-body">
                        <h2 class="uk-modal-title uk-text-warning">Предупреждение!</h2>
                        <p> Вы действительно хотите удалить материал?</p>
                        <p class="uk-text-right">
                            <button class="uk-button uk-button-default uk-modal-close" type="button">Нет</button>
                            <button class="uk-button uk-button-primary" @click="deletePage" type="button">ДА!</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal-icon-overflow" ref="modal-icon-overflow" uk-modal>
            <div class="uk-modal-dialog">

                <button class="uk-modal-close-default" type="button" uk-close></button>

                <div class="uk-modal-header">
                    <h2 class="uk-modal-title">Галерея</h2>
                    <div>
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
                    </div>
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
                    <button class="uk-button uk-button-primary" @click="setIcon()" type="button">Применить</button>
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
                    type_of_product: 'required',
                    price: 'required',
                    brand: 'required',
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
                create_icon: false,
                dir_name: '',
                type_of_product_list: [],
                present_list: [],
            }
        },
        mounted() {
            this.delete_dialog = this.$refs['delete-save'];
            this.getBrands();
            this.getData();
            this.getTags();
            this.getPresents();
        },
        methods: {
            deletePage: function (item) {
                this.$http.delete('/admin/product/delete/' + this.delete_item.id).then(response => {
                    UIkit.modal(this.delete_dialog).hide();
                    setTimeout(() => {
                        location.href = '/admin/product/edit/' + list.parent_id;
                    }, 3000);
                });
            },
            Delete: function () {
                this.delete_item = this.list;
                UIkit.modal(this.delete_dialog).show();
            },
            getPresents: function () {
                this.$http.post('/admin/present/get').then(response => {
                    this.present_list = response.data.list;
                });
            },
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
            getBrands: function () {
                this.$http.get('/admin/brand/get/all').then(response => {
                    this.brand_list = response.data.list;
                });
            },
            getData: function () {
                this.$http.get('/admin/product/get/edit/' + this.id).then(response => {
                    this.list = response.data.list;
                    this.image_list = response.data.image_list;
                    this.child_list = response.data.child_list;
                    this.type_of_product_list = response.data.type_of_product_list;
                });
            },
            getTags: function () {
                this.$http.get('/admin/product/get/tags/' + this.id).then(response => {
                    this.tags = response.data;
                });
            },
            pageSave: function () {
                if (this.$validator.run(this.list, this.rules)) {
                    this.$http.post('/admin/product/save/' + this.id, this.list).then(response => {
                        UIkit.notification({message: 'Продукт успешно обновлен!', status: 'success'});
                    });
                }
            },
            createImage: function () {
                this.getGalleryListDir();
                UIkit.modal(this.$refs['modal-overflow']).show();
                this.create_image = true;
            },
            createIcon: function () {
                this.getGalleryListDir();
                UIkit.modal(this.$refs['modal-icon-overflow']).show();
                this.create_icon = true;
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
                this.$http.post('/admin/product/set_tag', {product_id: this.id, tag: item}).then(response => {
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
                this.$http.get('/admin/product/get/child_list/' + this.id).then(response => {
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
                    this.$http.put('/admin/product/add/', this.new_child).then(response => {
                        UIkit.notification({message: 'Продукт создан обновлен!', status: 'success'});
                        this.new_child = {};
                        this.getChildList();
                    });
                }
            },
            SaveChild: function (item) {
                if (this.$validator.run(item, this.rules)) {
                    this.$http.post('/admin/product/save/' + item.id, item).then(response => {
                        UIkit.notification({message: 'Продукт успешно обновлен!', status: 'success'});
                    });
                }
            },
            getGalleryList: function () {
                this.$http.get('/admin/product/get/images/' + this.id).then(response => {
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

            setIcon: function () {

                this.list.icons = this.list.icons || [];
                this.list.icons.push(this.current_image.image);
                UIkit.modal(this.$refs['modal-icon-overflow']).hide();
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
                axios.post('/admin/brochure/upload/' + this.id,
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    if (response.data.result) {
                        UIkit.notification({message: 'Брошюра успешно загружены!', status: 'success'});
                        this.list.brochure = response.data.result;
                    }
                })
                    .catch(function () {
                        UIkit.notification({message: 'При загрузки брошюры произошла ошибка!', status: 'danger'});
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
