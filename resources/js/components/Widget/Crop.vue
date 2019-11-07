<template>
    <div>
        <div class="uk-form">
            <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group">
                <button class="uk-button uk-button-danger" @click="Close()" type="button">Отмена</button>
                <button class="uk-button uk-button-success" @click="Save()" type="button">Сохранить</button>
                <button class="uk-button uk-button-primary" @click="center()" type="button">Центрировать</button>
            </div>
            <div class="uk-form-row uk-margin-bottom uk-margin-top">
                <button v-if="showMeta" title="Скрыть мета данные CROP" class="uk-button uk-button-primary"
                        @click="metaShow()"><i uk-icon="minus"></i></button>
                <button v-if="!showMeta" title="Показать мета данные CROP" class="uk-button uk-button-primary"
                        @click="metaShow()"><i uk-icon="plus"></i></button>
            </div>
            <div class="uk-form-row uk-margin-bottom uk-margin-top" v-if="showMeta">
                <div class="uk-form-row uk-margin-bottom uk-margin-top">
                    <label class="uk-form-label" for="dstY">dstY</label>
                    <div class="uk-form-controls">
                        <input id="dstX" type="number" v-model="dstX" @keyup="setX()">
                    </div>
                </div>
                <div class="uk-form-row uk-margin-bottom uk-margin-top">
                    <label class="uk-form-label" for="dstY">dstY</label>
                    <div class="uk-form-controls">
                        <input id="dstY" type="number" v-model="dstY" @keyup="setY()">
                    </div>
                </div>
                <div class="uk-form-row uk-margin-bottom uk-margin-top">
                    <label class="uk-form-label" for="dstY">dstW</label>
                    <div class="uk-form-controls">
                        <input id="dstW" type="number" v-model="dstW" @keyup="setW()">
                    </div>
                </div>
                <div class="uk-form-row uk-margin-bottom uk-margin-top">
                    <label class="uk-form-label" for="dstY">dstH</label>
                    <div class="uk-form-controls">
                        <input id="dstH" type="number" v-model="dstH" @keyup="setH()">
                    </div>
                </div>
            </div>

            <div class="uk-form-row uk-margin-bottom uk-margin-top">
                <div id="origin" class="uk-form-row uk-margin-bottom uk-margin-top"
                     :class="{'move':move==true,'rb':resize_cur==4}">
                    <canvas ref="canvas_1" width="100%" height="100%"></canvas>
                </div>
            </div>

            <div id="result" class="results uk-form-row uk-margin-bottom uk-margin-top">
                <canvas ref="canvas_2" width="100%" height="100%"></canvas>
            </div>
            <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group">
                <button class="uk-button uk-button-danger" @click="Close()" type="button">Отмена</button>
                <button class="uk-button uk-button-success" @click="Save()" type="button">Сохранить</button>
                <button class="uk-button uk-button-primary" @click="center()" type="button">Центрировать</button>
            </div>
            <div id="result_2" class="uk-form-row uk-margin-bottom uk-margin-top">
                <img alt="">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['image'],
        data() {
            return {
                push_dialog: false,
                X: 0,
                Y: 0,

                img_url: '',

                resize_cur: 0,
                drag: false,
                move: false,
                resize: false,
                showMeta: false,

                dstX: 0,
                dstY: 0,
                dstW: 800,
                dstH: 440,
                imgW: 440,
                imgH: 440,
                max_length_ln: 20,
                font_size: 30,
                dot_size: 20,

                img_w_url: "",

                canvas: null,
                canvas_2: null,
                canvas_w: null,
                img: null,
                img_w: null,

                data_w: null,
                mouse_pos: {
                    x: 0, y: 0,
                    xC: 0, yC: 0,
                },
                dots: {
                    1: {x: 0, y: 0},
                    2: {x: 0, y: 440},
                    3: {x: 800, y: 0},
                    4: {x: 800, y: 440},
                },

            }
        },
        watch: {
            image: function () {
                console.log(this.image);
                this.img_w_url = this.image;
            }
        },
        mounted() {

            console.log(this.image);

            this.img_w = new Image();
            this.img_w.src = this.img_w_url;
            this.canvas = this.$refs['canvas_1'];
            this.canvas_2 = this.$refs['canvas_2'];
            this.img = new Image();

            this.img.addEventListener('load', this.init);

            this.img.src = this.image;

        },
        methods: {
            Close: function () {
                this.$emit('close', {});
            },
            init: function () {

                this.img.addEventListener('load', this.render);

                this.canvas.addEventListener('mousemove', this.getMousePos);
                this.canvas.addEventListener('mousedown', this.eventMouse);
                this.canvas.addEventListener('mouseup', this.endDrag);

                this.canvas.addEventListener('touchstart', this.getMousePosTouch, false);
                this.canvas.addEventListener('touchmove', this.touchstart, false);
                this.canvas.addEventListener('touchend', this.endDrag);

                this.render();
            },

            touchstart: function (evt) {

                let Pints = evt.changedTouches;

                let initPoint = Pints[0];

                if (Pints.length > 1) {

                    this.resize = true;
                    this.drag = false;
                    initPoint = (Pints[0].pageX > Pints[1].pageX ? Pints[0] : Pints[1]);
                    this.Resize(initPoint);
                } else {
                    this.resize = false;
                    this.drag = true;
                    initPoint = Pints[0];
                    this.Move(initPoint);
                }

                console.log(initPoint);
                this.render();
            },

            getMousePosTouch: function (evt) {

                // console.log(evt);

                evt.preventDefault();
                evt.stopPropagation();
                let Pints = evt.changedTouches;

                let initPoint = Pints[0];

                if (Pints.length > 1) {
                    this.resize = true;
                    this.drag = false;
                    initPoint = (Pints[0].pageX > Pints[1].pageX ? Pints[0] : Pints[1]);
                } else {
                    this.resize = false;
                    this.drag = true;
                    initPoint = Pints[0];
                }

                console.log(initPoint);


                // initialPoint.buttons = 1;
                // this.eventMouse(initPoint);
            },

            Resize: function (evt) {
                let mouseX, mouseY;

                let pos = this.canvas.getBoundingClientRect();

                let ratioW = this.img.width / pos.width;
                let ratioH = this.img.height / pos.height;
                let offsetTop = this.canvas.offsetTop;


                this.mouse_pos = {
                    x: evt.pageX - pos.left, y: evt.pageY - offsetTop,
                    xC: (evt.pageX - pos.left) * ratioW, yC: (evt.pageY - offsetTop) * ratioH,
                };

                mouseX = this.mouse_pos.xC - this.dstX;
                mouseX = (mouseX < 0 ? 1 : mouseX);
                this.dstW = mouseX;
                this.dstH = Math.round(mouseX / 1.82);

                this.dots = {

                    1: {x: this.dstX, y: this.dstY},
                    2: {x: this.dstX, y: this.dstY + this.dstH},
                    3: {x: this.dstX + this.dstW, y: this.dstY},
                    4: {x: this.dstX + this.dstW, y: this.dstY + this.dstH},

                };

                this.render();

            },
            Move: function (evt) {

                let mouseX, mouseY;

                let pos = this.canvas.getBoundingClientRect();

                let ratioW = this.img.width / pos.width;
                let ratioH = this.img.height / pos.height;
                let offsetTop = this.canvas.offsetTop;


                this.mouse_pos = {
                    x: evt.pageX - pos.left, y: evt.pageY - offsetTop,
                    xC: (evt.pageX - pos.left) * ratioW, yC: (evt.pageY - offsetTop) * ratioH,
                };

                mouseX = this.mouse_pos.xC - this.dstW / 2;
                mouseY = this.mouse_pos.yC - this.dstH / 2;

                this.dstX = (mouseX < 0 ? 0 : ((mouseX + this.dstW) > this.img.width ? this.img.width - this.dstW : mouseX));
                this.dstY = (mouseY < 0 ? 0 : ((mouseY + this.dstH) > this.img.height ? this.img.height - this.dstH : mouseY));

                this.dots = {

                    1: {x: this.dstX, y: this.dstY},
                    2: {x: this.dstX, y: this.dstY + this.dstH},
                    3: {x: this.dstX + this.dstW, y: this.dstY},
                    4: {x: this.dstX + this.dstW, y: this.dstY + this.dstH},

                };

            },

            getMousePos: function (evt) {

                let pos = this.canvas.getBoundingClientRect();

                let ratioW = this.img.width / pos.width;
                let ratioH = this.img.height / pos.height;
                let offsetTop = this.canvas.offsetTop;


                this.mouse_pos = {
                    x: evt.pageX - pos.left, y: evt.pageY - offsetTop,
                    xC: (evt.pageX - pos.left) * ratioW, yC: (evt.pageY - offsetTop) * ratioH,
                };

                // console.log({drag:this.drag,resize:this.resize});


                let mouseX, mouseY;


                if (this.drag) {

                    mouseX = this.mouse_pos.xC - this.dstW / 2;
                    mouseY = this.mouse_pos.yC - this.dstH / 2;

                    this.dstX = (mouseX < 0 ? 0 : ((mouseX + this.dstW) > this.img.width ? this.img.width - this.dstW : mouseX));
                    this.dstY = (mouseY < 0 ? 0 : ((mouseY + this.dstH) > this.img.height ? this.img.height - this.dstH : mouseY));

                    this.dots = {

                        1: {x: this.dstX, y: this.dstY},
                        2: {x: this.dstX, y: this.dstY + this.dstH},
                        3: {x: this.dstX + this.dstW, y: this.dstY},
                        4: {x: this.dstX + this.dstW, y: this.dstY + this.dstH},

                    };
                }


                // console.log(mouse);
                //
                // if (((mouse.xC >= this.dots[4]['x'] - 20) && (mouse.xC <= this.dots[4]['x'] + 20)) && ((mouse.yC >= this.dots[4]['y'] - 20) && (mouse.yC <= (this.dots[4]['y'] + 20)))) {
                //     console.log('resize');
                //     this.resize_cur = 4;
                // } else {
                //     this.resize_cur = 0;
                // }
                // //
                // //
                if (this.resize) {
                    mouseX = this.mouse_pos.xC - this.dstX;
                    mouseX = (mouseX < 0 ? 1 : mouseX);
                    this.dstW = mouseX;
                    this.dstH = Math.round(mouseX / 1.82);

                    this.dots = {

                        1: {x: this.dstX, y: this.dstY},
                        2: {x: this.dstX, y: this.dstY + this.dstH},
                        3: {x: this.dstX + this.dstW, y: this.dstY},
                        4: {x: this.dstX + this.dstW, y: this.dstY + this.dstH},

                    };

                }
                //
                // if (this.drag) {
                //
                //
                //     let mouseX = this.mouse_pos.xC - this.dstW / 2;
                //     let mouseY = this.mouse_pos.yC - this.dstH / 2;
                //
                //     // this.dstX = mouse.xC;
                //     // this.dstY = mouse.yC;
                //
                //     this.dstX = (mouseX < 0 ? 0 : ((mouseX + this.dstW) > this.img.width ? this.img.width - this.dstW : mouseX));
                //     this.dstY = (mouseY < 0 ? 0 : ((mouseY + this.dstH) > this.img.height ? this.img.height - this.dstH : mouseY));
                //
                //     this.dots = {
                //
                //         1: {x: this.dstX, y: this.dstY},
                //         2: {x: this.dstX, y: this.dstY + this.dstH},
                //         3: {x: this.dstX + this.dstW, y: this.dstY},
                //         4: {x: this.dstX + this.dstW, y: this.dstY + this.dstH},
                //
                //     };
                // }

                this.render();


                // return {
                //     x: mouseX,
                //     y: mouseY
                // }
            },


            render: function () {
                // let this = this;

                this.imgW = this.img.width;
                this.imgH = this.img.height;
                this.canvas.width = this.imgW;
                this.canvas.height = this.imgH;
                this.canvas.style.width = '100%';


                let ctx = this.canvas.getContext('2d');

                ctx.drawImage(this.img, 0, 0);
                let data = ctx.getImageData(this.dstX, this.dstY, this.dstW, this.dstH);

                /*Overlay start*/
                ctx.strokeStyle = "rgba(0,0,0,.5)";
                ctx.fillStyle = "rgba(0,0,0,.5)";
                ctx.lineWidth = "3";

                ctx.rect(0, 0, this.dstX, this.dstY);
                ctx.rect(0, this.dstY + this.dstH, this.dstX, this.img.height);

                ctx.rect(this.dstX + this.dstW, 0, this.img.width, this.dstY);
                ctx.rect(this.dstX + this.dstW, this.dstY + this.dstH, this.img.width, this.img.height);

                ctx.rect(0, this.dstY, this.dstX, this.dstH);
                ctx.rect(this.dstX + this.dstW, this.dstY, this.img.width, this.dstH);


                ctx.rect(this.dstX, 0, this.dstW, this.dstY);
                ctx.rect(this.dstX, this.dstY + this.dstH, this.dstW, this.img.height);


                ctx.stroke();
                ctx.fill();
                /*Overlay end*/

                ctx.rect(this.dstX, this.dstY, this.dstW, this.dstH);
                ctx.lineWidth = "3";
                ctx.strokeStyle = "#FFF";

                ctx.stroke();

                /*Grid start*/
                let step_h = this.dstH / 11;

                for (let i = 0; i <= 11; i++) {
                    ctx.beginPath();
                    ctx.moveTo(this.dstX, this.dstY + (step_h * i));
                    ctx.lineTo(this.dstX + this.dstW, this.dstY + (step_h * i));
                    ctx.stroke();
                }

                let step_w = this.dstW / 20;

                for (let i = 0; i <= 20; i++) {
                    ctx.beginPath();
                    ctx.moveTo(this.dstX + (step_w * i), this.dstY);
                    ctx.lineTo(this.dstX + (step_w * i), this.dstY + this.dstH);
                    ctx.stroke();
                }
                /*Grid end*/

                for (let dot in this.dots) {
                    ctx.fillStyle = "#fff";
                    if (dot == '4') {
                        if (this.resize) {
                            ctx.fillStyle = "#ff0006";
                        } else {
                            ctx.fillStyle = "#fffb25";
                        }
                    }
                    if (dot == '4') {
                        if(screen.width < 700) {
                            this.dot_size = 200;
                        }else{
                            this.dot_size = 80;
                        }
                    }else{
                        this.dot_size = 30;
                    }
                    ctx.fillRect(this.dots[dot]['x'] - (this.dot_size / 2), this.dots[dot]['y'] - (this.dot_size / 2), this.dot_size, this.dot_size);
                    ctx.stroke();
                    ctx.fill();
                }

                this.canvas_2.width = data.width;
                this.canvas_2.height = data.height;
                this.canvas_2.style.width = '100%';

                let ctx2 = this.canvas_2.getContext('2d');

                ctx2.putImageData(data, 0, 0);
                ctx2.drawImage(this.img_w, data.width - (this.img_w.width * (data.width / 800)), data.height - (this.img_w.height * (data.height / 440)), 110 * (data.width / 800), 45 * (data.height / 440));
            },


            eventMouse: function (evt) {

                let mouseX, mouseY;


                if (((this.mouse_pos.xC >= this.dstX + 20) && (this.mouse_pos.xC <= (this.dstX + this.dstW) - 20)) && ((this.mouse_pos.yC >= this.dstY + 20) && (this.mouse_pos.yC <= (this.dstY + this.dstH - 20)))) {
                    this.canvas.style.cursor = 'move';
                    if (evt.buttons === 1) {
                        this.drag = true;
                    } else {
                        this.canvas.style.cursor = 'default';
                        this.drag = false;

                    }
                }

                if (((this.mouse_pos.xC >= this.dots[4]['x'] - this.dot_size) && (this.mouse_pos.xC <= this.dots[4]['x'] + this.dot_size)) && ((this.mouse_pos.yC >= this.dots[4]['y'] - this.dot_size) && (this.mouse_pos.yC <= (this.dots[4]['y'] + this.dot_size)))) {
                    this.canvas.style.cursor = 'pointer';
                    this.resize = true;
                } else {
                    this.canvas.style.cursor = 'default';
                    this.resize = false;
                }

            },

            endDrag: function () {
                this.drag = false;
                this.resize = false;
            },

            setW: function () {
                this.dstW = parseInt(this.dstW);
                this.dstH = Math.round(this.dstW / 1.82);
                this.render();
            },

            setH: function () {
                this.dstH = parseInt(this.dstH);

                this.dstW = Math.round(this.dstH * 1.82);
                this.render();
            },

            setX: function () {
                this.dstX = parseInt(this.dstX);
                this.render();
            },

            setY: function () {
                this.dstY = parseInt(this.dstY);
                this.render();
            },

            center: function () {
                this.dstX = (Math.round((this.imgW - this.dstW) / 2));
                this.dstY = (Math.round((this.imgH - this.dstH) / 2));
                this.dots = {

                    1: {x: this.dstX, y: this.dstY},
                    2: {x: this.dstX, y: this.dstY + this.dstH},
                    3: {x: this.dstX + this.dstW, y: this.dstY},
                    4: {x: this.dstX + this.dstW, y: this.dstY + this.dstH},

                };

                this.render();
            },

            Save: function () {
                let result = {
                    x: this.dstX, y: this.dstY,
                    w: this.dstW, h: this.dstH
                };

                this.$emit('crop', result);
            },

            metaShow: function () {
                this.showMeta = !this.showMeta;
            },
        }

    }
</script>