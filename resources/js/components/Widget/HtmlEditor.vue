<template>
	<div class="uk-position-relative">
		<div id="modal-edit-properties" uk-modal>
			<div class="uk-modal-dialog uk-modal-body">
				<h2 class="uk-modal-title">Свойства объекта <strong v-html="properties.tag_name"></strong></h2>
				<div class="uk-margin">
					<div class="uk-inline" v-if="properties.width">
						<span class="uk-form-icon uk-icon" href="#" uk-icon="width"></span>
						<input placeholder="Ширина" autocomplete="off" v-model="properties.width" class="uk-input" type="text" title="Ширина">
					</div>
					<div class="uk-inline" v-if="properties.height">
						<span class="uk-form-icon uk-icon" href="#" uk-icon="height"></span>
						<input placeholder="Высота" autocomplete="off" v-model="properties.height" class="uk-input" type="text" title="Высота">
					</div>
					<div class="uk-margin-small" v-if="properties.href">
						<div class="uk-inline uk-width-1-1">
							<span class="uk-form-icon uk-icon" href="#" uk-icon="link"></span>
							<input placeholder="Ссыла" autocomplete="off" v-model="properties.href" class="uk-input" type="text" title="Ссыла">
						</div>
						<div class="uk-margin-small">
							<label class="uk-form-label">Nofollow:</label>
							<div class="uk-form-controls">
								<div class="onoffswitch-small">
									<input type="checkbox" class="onoffswitch-checkbox" id="nofollow" v-model="properties.nofollow">
									<label class="onoffswitch-label" for="nofollow"></label>
								</div>
							</div>
						</div>
					</div>
					<div class="uk-margin-small" v-if="properties.src">
						<div class="uk-inline uk-width-1-1">
							<span class="uk-form-icon uk-icon" href="#" uk-icon="link"></span>
							<input placeholder="Ссыла" autocomplete="off" v-model="properties.src" class="uk-input" type="text" title="Ссыла">
						</div>
					</div>
				</div>
				<ul uk-accordion>
					<li>
						<a class="uk-accordion-title" href="#">Классы</a>
						<div class="uk-accordion-content">
							<div class="uk-form-horizontal uk-margin-large">
								<div class="uk-margin">
									<label for="authors" class="uk-form-label">Class</label>
									<div class="uk-form-controls">
										<div class="uk-inline uk-width-1-1">
											<button uk-icon="icon: plus" class="uk-button-primary uk-form-icon uk-form-icon-flip" @click="AddClass"></button>
											<input id="authors" type="text" placeholder="Add class" autocomplete="off" v-model="class_name" class="uk-input">
										</div>
										<div class="uk-flex uk-margin-small">
											<div class="uk-badge uk-margin-small-right"
												 v-for="(val,index) in properties.classes" v-if="val.length">
												{{val}}
												<a @click="removeClass(index)" uk-icon="close"
												   class="uk-button-danger uk-border-rounded uk-margin-small-left"></a>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</li>
					<li>
						<a class="uk-accordion-title" href="#">Item 2</a>
						<div class="uk-accordion-content">
							<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
								commodo consequat. Duis aute irure dolor reprehenderit.</p>
						</div>
					</li>
					<li>
						<a class="uk-accordion-title" href="#">Item 3</a>
						<div class="uk-accordion-content">
							<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
								nulla pariatur. Excepteur sint occaecat cupidatat proident.</p>
						</div>
					</li>
				</ul>
				<p class="uk-text-right">
					<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
					<button class="uk-button uk-button-primary" @click="Apply" type="button">Save</button>
				</p>
			</div>
		</div>
		<div id="modal-add-video" uk-modal>
			<div class="uk-modal-dialog uk-modal-body">
				<h2 class="uk-modal-title">Добавление видео</h2>
				<ul class="uk-subnav uk-subnav-pill" uk-switcher>
					<li><a href="#">YouTube</a></li>
					<li><a href="#">Код вставки</a></li>
				</ul>

				<ul class="uk-switcher uk-margin">
					<li>
						<div class="uk-form-controls">

							<div class="uk-margin">
								<label for="video_url" class="uk-form-label">URL</label>
								<div class="uk-form-controls">
									<input id="video_url" type="text" placeholder="Add video url" autocomplete="off" v-model="video_url.url" class="uk-input">
								</div>
							</div>
							<div class="uk-margin">
								<label for="video_width" class="uk-form-label">Width</label>
								<div class="uk-form-controls">
									<input id="video_width" type="text" placeholder="Add video width" autocomplete="off" v-model="video_url.width" class="uk-input">
								</div>
							</div>
							<div class="uk-margin">
								<label for="video_height" class="uk-form-label">Height</label>
								<div class="uk-form-controls">
									<input id="video_height" type="text" placeholder="Add video height" autocomplete="off" v-model="video_url.height" class="uk-input">
								</div>
							</div>
						</div>
						<p class="uk-text-right">
							<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
							<button class="uk-button uk-button-primary" @click="AddVideo" type="button">Add</button>
						</p>
					</li>
					<li>
						<div class="uk-form-controls">
							<div class="uk-inline uk-width-1-1">
								<textarea id="video_code" type="text" placeholder="Add video code" autocomplete="off" v-model="video_code" class="uk-textarea" rows="5"></textarea>
							</div>
						</div>
						<p class="uk-text-right">
							<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
							<button class="uk-button uk-button-primary" @click="AddVideoCode" type="button">Add</button>
						</p>

					</li>
				</ul>
			</div>
		</div>

		<div class="tn_editor_tool_bar">
			<div class="uk-button-group" v-for="val in buttons">
				<div v-for="item in val">
                    <span v-if="item.child" class="tn_editor_tool_bar_button"
						  uk-icon="triangle-down">{{item.title}}</span>
					<div v-if="item.child" class="uk-padding-small" uk-dropdown="">
						<ul class="uk-nav uk-dropdown-nav">
							<li class="tn_editor_tool_bar_button" v-for="_item in item.child" @click="exec(_item)"><span
									:title="_item.title" :uk-icon="_item.icon"></span>{{_item.title}}
							</li>
						</ul>
					</div>
					<span v-if="!item.child" @click="exec(item)" :title="item.title" class="tn_editor_tool_bar_button"
						  :uk-icon="item.icon"></span>
				</div>
			</div>
		</div>
		<div class="tn_editor">
			<iframe scrolling="on" frameborder="on" src="#" class="tn_editor_container"></iframe>
			<textarea class="uk-textarea tn-editor-code" v-if="show_code" rows="5" v-model="text" @change="AddContent(text);"></textarea>

		</div>
		<div class="tn_editor_tool_bar">
			Количество символов : {{character_count}}
		</div>
		<input type="file" name="image" @change="onUpload">
	</div>
</template>

<script>
    export default {
        model: {
            prop: 'checked',
            event: 'change'
        },
        props: {
            checked: {},
			id: {},
			is_card: {}
        },
        data() {
            return {
                text: "",
                class_name: "",
                show_code: false,
                video_url: {
                    url: "#",
                    width: 560,
                    height: 315,
                    nofollow: false,
                },
                editor_container: {},
                editor_iframe: {},
                editor_window: {},
                editor_document: {},
                editor_head: {},
                editor_body: {},
                upload_input: {},
                edit_properties: {},
                current_edit_element: {},
				character_count: 0,
                add_video: {},
                video_code: "",
                properties: {
                    classes: [],
                },
                buttons: [
                    [
                        {
                            title: 'Формат', child: [
                            {action: 'FormatBlock', icon: 'tag', value: 'H1', title: 'H1'},
                            {action: 'FormatBlock', icon: 'tag', value: 'H2', title: 'H2'},
                            {action: 'FormatBlock', icon: 'tag', value: 'H3', title: 'H3'},
                            {action: 'FormatBlock', icon: 'tag', value: 'H4', title: 'H4'},
                            {action: 'FormatBlock', icon: 'tag', value: 'P', title: 'Normal'},
                        ]
                        },
                    ],
                    [
                        {action: 'Bold', icon: 'bold', value: '', title: 'Полужирный'},
                        {action: 'Italic', icon: 'italic', value: '', title: 'Курсив'},
                        {action: 'ClearFormat', icon: 'eraser', value: '', title: 'Очистить формат'},
                    ],
                    [

                        {action: 'JustifyLeft', icon: "justify-left", value: '', title: 'По левому краю'},
                        {action: 'JustifyCenter', icon: "justify-center", value: '', title: 'По центру'},
                        {action: 'JustifyRight', icon: "justify-right", value: '', title: 'По правому краю'},
                        {action: 'JustifyFull', icon: "justify-full", value: '', title: 'По ширине'},
                        {action: 'OrderedList', icon: "list", value: '', title: 'Нумерованный список'},
                        {action: 'UnorderedList', icon: "list", value: '', title: 'Маркерованный список'},
                    ],
                    [
                        {action: 'CreateLink', icon: 'link', value: '#', title: 'Вставить ссылку'},
                        {action: 'InsertImage', icon: 'image', value: '', title: 'Вставить изображение'},
                        {action: 'InsertVideo', icon: 'video-camera', value: '', title: 'Вставить видео'},
                    ],
                    [
                        {
                            title: 'Конвертировать', child: [
                            {action: 'LatToCurl', icon: 'lat', value: '', title: 'С латиницы в кириллицу'},
                            {action: 'CurlToLat', icon: 'curl', value: '', title: 'С кириллицы в латиницу'},
                        ]
                        },
                    ],

                    [
                        {
                            title: 'Слайдер', child: [
                            {action: 'AddSlider', icon: 'slider', value: '', title: 'Добавить слайдер'},
                            {action: 'AddSlide', icon: 'image', value: '', title: 'Добавить слайд'},
                        ]
                        },
                    ],
                    [
                        {action: 'ShowCode', icon: 'code', value: '', title: 'Показать код'},
                    ],
                ],
            }
        },
        watch: {
            is_card:function () {
                if (this.is_card) {
                    this.buttons.push(
                        [
                            {
                                title: 'Карточки', child: [
                                {action: 'AddCard', icon: 'copy', value: '', title: 'Вставить карточку'},
                                {action: 'AddCardCustom', icon: 'copy', value: '', title: 'Вставить произвольный текст'},
                                {action: 'setCardHeaderColor', icon: 'color', value: '', title: 'Цвет заголовка '},
                            ],
                            },
                        ],
                    );
                }

            },
            checked: function () {
                if (!this.text && this.checked || this.text ==='<p>&nbsp;</p>') {
                    this.text = this.checked;
                    this.AddContent(this.text);
                }


            },
        },
        mounted() {
            this.upload_input = this.$el.querySelector('input[type="file"]');
            this.edit_properties = this.$el.querySelector('#modal-edit-properties');
            this.add_video = this.$el.querySelector('#modal-add-video');
            this.Init();
            this.AddStyle();
            this.AddContent(this.checked);

        },
        methods: {
            _change: function (e) {
            },
            AddClass: function () {
                if (this.class_name) {
                    this.properties.classes.push(this.class_name);
                    this.class_name = '';
                }
            },
            removeClass: function (index) {
                this.properties.classes.splice(index, 1);
            },
            Apply: function () {
                let __class = this.properties.classes.join(' ');
                this.current_edit_element.classList.value = __class;

                if (this.properties.href) {
                    this.current_edit_element.setAttribute('href', this.properties.href);
                }

                if (this.properties.src) {
                    this.current_edit_element.setAttribute('src', this.properties.src);
                }

                if (this.properties.width) {
                    this.current_edit_element.setAttribute('width', this.properties.width);
                }

                if (this.properties.height) {
                    this.current_edit_element.setAttribute('height', this.properties.height);
                }

                if (this.properties.nofollow) {
                    this.current_edit_element.setAttribute('rel', 'nofollow');
                } else {
                    this.current_edit_element.setAttribute('rel', '');
                }

                UIkit.modal(this.edit_properties).hide();
                this.update(this.editor_body.innerHTML);
            },
            onUpload: function (e) {
                let files = e.target.files;
                let formData = new FormData();

                for (let i = 0; i < files.length; i++) {
                    formData.append('image', files[i]);
                }
                axios.post('/admin/upload/image',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    let data = response.data;
                    this.editor_window.focus();
                    this.editor_window.document.execCommand("insertImage", null, data.url);
                    UIkit.notification({message: 'Изображения успешно загружены!', status: 'success'});
                }).catch(function () {
                    UIkit.notification({message: 'При загрузки изображений произошла ошибка!', status: 'danger'});
                });

            },
            update: function (text) {
                this.$emit('change', text);
                this.text = text;
            },
            convert: function (method, text) {

                let translite_lat = {
                    А: "A", а: "a",
                    Ә: "A'", ә: "a'",
                    Б: "B", б: "b",
                    Д: "D", д: "d",
                    Е: "E", е: "e",
                    Ф: "F", ф: "f",
                    "Ғ": "G'", "ғ": "g'",
                    Г: "G", г: "g",
                    Х: "H", х: "h",
                    І: "I", i: "i",
                    І: "I", i: "i",
                    И: "I'", и: "i'",
                    Й: "I'", й: "i'",
                    H: "H", h: "h",
                    Ж: "J", ж: "j",
                    К: "K", к: "k",
                    Л: "L", л: "l",
                    М: "M", м: "m",
                    Н: "N", н: "n",
                    Ң: "N'", ң: "n'",
                    О: "O", о: "o",
                    Ө: "O'", ө: "o'",
                    П: "P", п: "p",
                    Қ: "Q", қ: "q",
                    Р: "R", р: "r",
                    Ш: "S'", ш: "s'",
                    С: "S", с: "s",
                    Т: "T", т: "t",
                    Ұ: "U", ұ: "u",
                    Ү: "U'", ү: "u'",
                    В: "V", в: "v",
                    Ы: "Y", ы: "y",
                    У: "Y'", у: "y'",
                    З: "Z", з: "z",
                    Ч: "C'", ч: "c'",
                    Э: "E", э: "e",
                    Щ: "s'", щ: "s'",
                    ь: '',
                    ъ: '',

                };

                let translite_kaz = {
                    "A'": "Ә", "a'": "ә",
                    "A": "А", "a": "а",
                    "B": "Б", "b": "б",
                    "D": "Д", "d": "д",
                    "E": "Е", "e": "е",
                    "F": "Ф", "f": "ф",
                    "G'": "Ғ", "g'": "ғ",
                    "G": "Г", "g": "г",
                    "H": "Х", "h": "х",
                    "I": "І", "i": "i",
                    "I": "І", "i": "i",
                    "I'": "Й", "i'": "й",
                    "I'": "И", "i'": "и",
                    "H": "H", "h": "h",
                    "J": "Ж", "j": "ж",
                    "K": "К", "k": "к",
                    "L": "Л", "l": "л",
                    "M": "М", "m": "м",
                    "N'": "Ң", "n'": "ң",
                    "N": "Н", "n": "н",
                    "O'": "Ө", "o'": "ө",
                    "O": "О", "o": "о",
                    "P": "П", "p": "п",
                    "Q": "Қ", "q": "қ",
                    "R": "Р", "r": "р",
                    "S'": "Ш", "s'": "ш",
                    "S": "С", "s": "с",
                    "T": "Т", "t": "т",
                    "U'": "Ү", "u'": "ү",
                    "U": "Ұ", "u": "ұ",
                    "V": "В", "v": "в",
                    "Y'": "У", "y'": "у",
                    "Z": "З", "z": "з",
                    "C'": "Ч", "c'": "ч",
                    "Y": "Ы", "y": "ы",
                    "s'": "Щ", "s'": "щ"

                };

                let _translate_kaz = {
                    "I'a'": "Иә", "i'a'": "иә",
                    "I'a": "Я", "i'a": "я",
                    "I'y'": "Ю", "i'y'": "ю",
                };
                let _translate_lat = {
                    Я: "I'a", я: "i'a",
                    Ю: "I'y'", ю: "i'y'",
                    Ц: "Ts", ц: "ts"

                };

                if (method === 'lat') {
                    text += "";
                    for (let key in _translate_lat) {
                        text = text.replace(new RegExp(key.toString(), 'g'), _translate_lat[key]);
                    }

                    for (let key in translite_lat) {
                        text = text.replace(new RegExp(key.toString(), 'g'), translite_lat[key]);
                    }

                    return text;
                }

                if (method === 'kaz') {

                    text += "";
                    for (let key in _translate_kaz) {
                        text = text.replace(new RegExp(key.toString(), 'g'), _translate_kaz[key]);
                    }

                    for (let key in translite_kaz) {
                        text = text.replace(new RegExp(key.toString(), 'g'), translite_kaz[key]);
                    }

                    return text;
                }

            },
            ShowCode:function () {
				this.show_code = !this.show_code;
            },
            CurlToLat: function () {
                let content = this.editor_body.innerHTML;

                let div = document.createElement('div');
                div.innerHTML = content;
                let child = div.childNodes;
                for (let item in child) {
                    let temp = child[item].childNodes;
                    for (let i in temp) {
                        if (temp[i].nodeName === 'A' || temp[i].nodeName === 'IFRAME') {
                            break;
                        }
                        if (temp[i].nodeName === '#text') {
                            child[item].innerText = this.convert('lat', child[item].innerText);
                        }
                    }
                }
//
                this.text = div.innerHTML;
                this.AddContent(div.innerHTML);
            },
            LatToCurl: function () {
                let content = this.editor_body.innerHTML;
                let div = document.createElement('div');
                div.innerHTML = content;
                let child = div.childNodes;
                for (let item in child) {
                    let temp = child[item].childNodes;
                    for (let i in temp) {
                        if (temp[i].nodeName === 'A' || temp[i].nodeName === 'IFRAME') {
                            break;
                        }
                        if (temp[i].nodeName === '#text') {
                            child[item].innerText = this.convert('kaz', child[item].innerText);
                        }
                    }
                }
//
//                content = this.convert('lat',content);
                this.text = div.innerHTML;
                this.AddContent(div.innerHTML);
            },
            ClearFormat: function () {
                let validate = {
                    '&nbsp;': ' ',
                    '&ensp;': '  ',
                    '&emsp;': '   ',
                    '&ndash;': '–',
                    '&mdash;': '—',
                    '&shy;': '&shy;',
                    '&copy;': '©',
                    '&reg;': '®',
                    '&trade;': '™',
                    '&ordm;': 'º',
                    '&ordf;': 'ª',
                    '&permil;': '‰',
                    '&pi;': 'π',
                    '&laquo;': '"',
                    '&raquo;': '"',
                    '«': '"',
                    '»': '"',
                    '&lt;': '<',
                    '&gt;': '>'
                };

                let nodes = this.editor_body.querySelectorAll('[style]');

                for (let node=0; node < nodes.length; node++) {
                    nodes[node].removeAttribute('style');
                }

                let content = this.editor_body.innerHTML;

                for (let key in validate) {
                    content = content.replace(new RegExp(key.toString(), 'g'),validate[key].toString() );
                }
                this.AddContent(content);
                this.text = content;
            },
            AddSlider: function () {
                this.editor_window.focus();
                this.editor_window.document.execCommand("insertHTML", null, "<p><div class=\"text_slider\"><span class=\"prev tn-hidden-mobile\">&nbsp;</span><span class=\"next tn-hidden-mobile\">&nbsp;</span><div class=\"slider-container\"><p class=\"item active\"></p></div><ul class=\"slider-dot-nav\"><li>&nbsp;</li></ul></div></p>");
            },
            AddSlide: function () {
                let container = this.findContainer(this.current_edit_element, 'slider-container');
                if (container) {
                    let item = document.createElement('P');
                    item.classList.add('item');
                    item.innerHTML = "&nbsp;";
                    container.append(item);
                }

            },
            AddCard: function () {
                if (!this.findContainer(this.current_edit_element, 'custom') && !this.findContainer(this.current_edit_element, 'custom-content') && !this.findContainer(this.current_edit_element, 'custom-content') && !this.findContainer(this.current_edit_element, 'card-title') && !this.findContainer(this.current_edit_element, 'card-content')) {
                    this.editor_window.focus();
                    this.editor_window.document.execCommand("insertHTML", null, "<p><div class=\"card-wrap\"><div class=\"card-title\">&nbsp;</div><div class=\"card-content\"><p>&nbsp;</p></div></div></p><p><br></p>");
                }
            },
            setCardHeaderColor: function () {
                if (this.current_edit_element.classList.contains('card-title')) {
                    this.current_edit_element.style.backgroundColor = 'rgb(67, 172, 56)';
                    this.current_edit_element.style.color = 'rgb(255, 255, 255)';
                }
            },
            AddCardCustom: function () {
                if (!this.findContainer(this.current_edit_element, 'custom') && !this.findContainer(this.current_edit_element, 'custom-content') && !this.findContainer(this.current_edit_element, 'custom-content') && !this.findContainer(this.current_edit_element, 'card-title') && !this.findContainer(this.current_edit_element, 'card-content')) {
                    this.editor_window.focus();
                    this.editor_window.document.execCommand("insertHTML", null, "<p><div class=\"custom\"><div class=\"custom-content\">&nbsp;</div></div></p><p><br></p>");
                }
            },
            findContainer: function (obj, _class) {
                if (obj.tagName !== 'HTML') {
                    if (obj.classList.value.indexOf(_class) > -1) {
                        return obj;
                    } else {
                        return this.findContainer(obj.parentNode, _class);
                    }
                } else {
                    return false;
                }
            },
            AddStyle: function () {
                let link = document.createElement('LINK');
                link.setAttribute('href', '/css/editor.css');
                link.setAttribute('rel', 'stylesheet');
                this.editor_head.append(link);
            },
            AddContent: function (text) {
                if(text) {
                    this.text = text;
                    this.editor_body.innerHTML = this.text;
                }else{
                    this.text = "<p>&nbsp;</p>";
                    this.editor_body.innerHTML = this.text;
                }
            },
            exec: function (command) {
                if (this[command.action]) {
                    this[command.action](command);
                }
            },
            Bold: function () {
                this.editor_window.focus();
                this.editor_window.document.execCommand("bold", null, "");
            },
            Italic: function () {
                this.editor_window.focus();
                this.editor_window.document.execCommand("italic", null, "");
            },
            InsertImage: function () {
                if (this.upload_input) {
                    this.upload_input.click();
                }
            },
            InsertVideo: function () {
                if (this.add_video) {
                    UIkit.modal(this.add_video).show();
                }
            },
            AddVideo: function () {
                if (this.video_url.url.indexOf('https://www.youtube.com/embed') <= -1) {
                    let url = this.video_url.url.split('?v=');
                    this.video_url.url = 'https://www.youtube.com/embed/' + url[1];
                }
                this.editor_window.focus();
                this.editor_window.document.execCommand("insertHTML", null, "<p><iframe width=\"" + this.video_url.width + "\" height=\"" + this.video_url.height + "\" src=\"" + this.video_url.url + "\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe></p><p><br></p>");
                this.video_url = {
                    url: "#",
                    width: 560,
                    height: 315,
                };
                this.video_code = '';
                UIkit.modal(this.add_video).hide();
            },
            AddVideoCode: function () {
                this.editor_window.focus();
                this.editor_window.document.execCommand("insertHTML", null, "<p>" + this.video_code + "</p><p><br></p>");
                this.video_url = {
                    url: "#",
                    width: 560,
                    height: 315,
                };
                this.video_code = '';
                UIkit.modal(this.add_video).hide();
            },
            JustifyLeft: function () {
                this.editor_window.focus();
                this.editor_window.document.execCommand("justifyLeft", null, "");
            },
            JustifyCenter: function () {
                this.editor_window.focus();
                this.editor_window.document.execCommand("justifyCenter", null, "");
            },
            JustifyRight: function () {
                this.editor_window.focus();
                this.editor_window.document.execCommand("justifyRight", null, "");
            },
            JustifyFull: function () {
                this.editor_window.focus();
                this.editor_window.document.execCommand("justifyFull", null, "");
            },
            UnorderedList: function () {
                this.editor_window.focus();
                this.editor_window.document.execCommand("insertUnorderedList", null, "");
            },
            OrderedList: function () {
                this.editor_window.focus();
                this.editor_window.document.execCommand("insertOrderedList", null, "");
            },
            CreateLink: function (href) {
                this.editor_window.focus();
                this.editor_window.document.execCommand("createLink", null, href.value);
            },
            FormatBlock: function (tag) {
                this.editor_window.focus();
                this.editor_window.document.execCommand("formatBlock", null, tag.value);
            },
            findPos: function (obj) {
                let curtop = 0;
                if (obj.offsetParent) {
                    do {
                        curtop += obj.offsetTop;
                    } while (obj = obj.offsetParent);
                    return [curtop];
                }
            },
            Init: function () {
                this.editor_container = this.$el.querySelector('.tn_editor');
                this.editor_iframe = this.editor_container.querySelector('IFRAME');

                let isGecko = navigator.userAgent.toLowerCase().indexOf("gecko") != -1;

                this.editor_window = (isGecko) ? this.editor_iframe.contentWindow : this.editor_iframe.window;
                this.editor_window.findPos = (obj) => {
                    let curtop = 0;
                    if (obj.offsetParent) {
                        do {
                            curtop += obj.offsetTop;
                        } while (obj = obj.offsetParent);
                        return curtop;
                    }
                };

                this.editor_window.preventDefault = (e) => {
                    return (e = e || this.editor_window.event).stopPropagation ? e.stopPropagation() : e.preventDefault && e.preventDefault(), e.cancelBubble = !0, e.cancel = !0, e.returnValue = !1, !1
                };

                this.editor_document = (isGecko) ? this.editor_iframe.contentDocument : this.editor_iframe.document;

// ***********************
// ШАГ 2: Добавим на пустую страницу ифрейма произвольный HTML-код
// ***********************

// Формируем HTML-код


                let iHTML = "<html><head></head>";
                iHTML += "<body><p>&nbsp;</p></body>";
                iHTML += "</html>";
// Добавляем его с помощью методов объекта document
                this.editor_document.open();
                this.editor_document.write(iHTML);
                this.editor_document.close();

                this.editor_body = this.editor_document.body;
                this.editor_head = this.editor_document.head;
                let _this = this;
                this.editor_document.addEventListener('click', function (e) {
                    _this.current_edit_element = e.target;
                });
                this.editor_document.addEventListener('contextmenu', function (e) {

                    _this.current_edit_element = e.target;

                    let __class = [];

                    __class = _this.current_edit_element.classList.value.split(' ');
                    if (__class.length === 1 && __class[0] === "") {
                        __class = [];
                    }

                    _this.properties.tag_name = _this.current_edit_element.tagName || 'P';
                    _this.properties.classes = __class || [];
                    _this.properties.href = _this.current_edit_element.getAttribute('href') || false;
                    _this.properties.src = _this.current_edit_element.getAttribute('src') || false;
                    _this.properties.height = _this.current_edit_element.getAttribute('height') || false;
                    _this.properties.width = _this.current_edit_element.getAttribute('width') || false;
                    _this.properties.nofollow = _this.current_edit_element.getAttribute('rel') === 'nofollow' || false;



                    UIkit.modal(_this.edit_properties).show();

                    _this.editor_window.preventDefault();
                    return false;
                });

                this.editor_body.addEventListener('DOMSubtreeModified', () => {
                    _this.update(this.editor_body.innerHTML);
                    _this.character_count = this.editor_body.innerText.length;
                });

// ***********************
// ШАГ 3: Инициализация свойства designMode объекта document
// ***********************

                if (!this.editor_document.designMode) alert("Визуальный режим редактирования не поддерживается Вашим браузером");
                else this.editor_document.designMode = (isGecko) ? "on" : "On";

            }
        }

    }
</script>

<style>

	.uk-button-group::after {
		content: "";
		border: 1px solid #e5e5e5;
	}

	.tn_editor_tool_bar {
		border: 1px solid #e5e5e5;
		box-sizing: border-box;
		padding: 5px;
	}

	.tn_editor_tool_bar .uk-button-group {
		margin: 5px 5px 5px 0;
	}

	.tn_editor_tool_bar .tn_editor_tool_bar_button {
		padding: 3px 7px;
		background-color: transparent;
		color: #333;
		border: 1px solid #e5e5e5;
		cursor: pointer;
		margin-left: 0;
		margin-right: 5px;
	}

	.tn_editor_tool_bar .tn_editor_tool_bar_button:hover {
		box-shadow: 0 0 5px rgba(0, 0, 0, .3);
	}

	.tn_editor {
		position: relative;
		width: 100%;
		min-height: 500px;
		border: 1px solid #e5e5e5;
		box-sizing: border-box;
	}

	.tn_editor .tn_editor_container {
		width: 100%;
		height: 500px;
		box-sizing: border-box;
	}

	.tn_modal {
		width: 100%;
		position: absolute;
		height: 100%;
		top: 0;
		z-index: 5;
		display: flex;
		justify-content: center;
		padding: 10px;
		box-sizing: border-box;
	}

	.tn_modal_overlay {
		background: rgba(0, 0, 0, .5);
		position: absolute;
		width: 100%;
		height: 100%;
		top: 0;
	}

	.tn_modal_header, .tn_modal_footer {
		min-height: 35px;
		background: #fff;
		width: 100%;
		padding: 10px;
		position: relative;
		display: flex;
		align-items: center;
		box-sizing: border-box;
	}

	.tn_modal_close {
		position: absolute;
		right: 10px;

	}

	.tn_modal_body {
		min-height: 200px;
		background: #fff;
		border-top: 2px solid rgba(0, 0, 0, .5);
		border-bottom: 2px solid rgba(0, 0, 0, .5);
	}

	.tn_modal_container {
		width: 100%;
		z-index: 5;
	}

	.tn-editor-code {
		position: absolute;
		top: 0;
		left: 0;
		height: 100%;
	}

	input[name="image"]{
		opacity: 0;
	}
</style>