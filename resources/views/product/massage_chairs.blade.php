@extends('layouts.app')

@section('title')
    {{$title ?? 'Каталог'}} || Casa & More
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="/css/main-style.css?v=5" type="text/css"/>
    <link rel="stylesheet" href="/css/index.css?v=5" type="text/css"/>
    <link rel="stylesheet" href="/css/catalog.css?v=5" type="text/css"/>
@stop

@section('script')
    @parent
    <script>
        window.filter = {
            _token: document.head.querySelector('meta[name="csrf-token"]').content,
            method: '{{$method}}',
            price_from: 0,
            price_to: 0,
            color: [],
            weight: [],
            type_controller: [],
            sub_type_of_product: [],
            count_program: [],
            massage_area: [],
            remote_controller: null,
            zero_g: null,
            warming_up: null,
            available: null,
        };
    </script>

    <script>

        getData = function () {
            $.post("/product/filter", filter, function (data) {
                $('#container').html(data);

                $('.CardBoxPriceLike').on('click', sendToSelect);
            });
        };

        $(function () {
            $('.FilterSort a').click(function (i) {

                if (!this.classList.contains('active')) {
                    this.classList.remove('revert');
                }

                let buttons = document.querySelectorAll('.FilterSort a');
                if (buttons) {
                    buttons.forEach((i) => {
                        if (i !== this) {
                            i.classList.remove('active');
                        }
                    });
                }


                if ($(this).hasClass('active')) {
                    $(this).toggleClass('revert');
                    filter.sort_field = $(this).data('sort');

                    if ($(this).hasClass('revert')) {
                        filter.sort_method = 'DESC';
                    } else {
                        filter.sort_method = 'ASC';
                    }
                } else {
                    $(this).addClass('active');
                    filter.sort_field = $(this).data('sort');
                    filter.sort_method = 'ASC';
                }
                getData();
                return false;
            });

            $('.CardFilterCheck input[data-color]').change(function (i) {
                if ($(i.target).prop("checked")) {
                    filter.color.push($(i.target).data('color'));
                    $('[data-field="color"]').addClass('active');
                    getData();
                } else {
                    filter.color.splice(filter.color.indexOf($(i.target).data('color')), 1);
                    if (!filter.color.length) {
                        $('[data-field="color"]').removeClass('active');
                    }
                    getData();
                }
            });

            $('.CardFilterCheck input[data-sub_type_of_product]').change(function (i) {
                if ($(i.target).prop("checked")) {
                    filter.sub_type_of_product.push($(i.target).data('sub_type_of_product'));
                    $('[data-field="sub_type_of_product"]').addClass('active');
                    getData();
                } else {
                    filter.sub_type_of_product.splice(filter.color.indexOf($(i.target).data('sub_type_of_product')), 1);
                    if (!filter.sub_type_of_product.length) {
                        $('[data-field="sub_type_of_product"]').removeClass('active');
                    }
                    getData();
                }
            });

            $('.CardFilterCheck input[data-weight]').click(function (i) {
                if ($(i.target).prop("checked")) {
                    filter.weight.push($(i.target).data('weight'));
                    $('[data-field="weight"]').addClass('active');
                    getData();
                } else {
                    filter.weight.splice(filter.weight.indexOf($(i.target).data('weight')), 1);
                    if (!filter.weight.length) {
                        $('[data-field="weight"]').removeClass('active');
                    }
                    getData();
                }
            });


            $('.CardFilterCheck input[data-type_controller]').change(function (i) {
                if ($(i.target).prop("checked")) {
                    filter.type_controller.push($(i.target).data('type_controller'));
                    $('[data-field="type_controller"]').addClass('active');
                    getData();
                } else {
                    filter.type_controller.splice(filter.type_controller.indexOf($(i.target).data('type_controller')), 1);
                    if (!filter.type_controller.length) {
                        $('[data-field="type_controller"]').removeClass('active');
                    }
                    getData();
                }
            });

            $('.CardFilterCheck input[data-remote_controller]').change(function (i) {

                let change = false;

                $.each($('.CardFilterCheck input[data-remote_controller]'), function (i, e) {
                    if (change || e.checked) {
                        change = true;
                    }
                });

                if (!change) {
                    $('[data-field="remote_controller"]').removeClass('active');
                    filter.remote_controller = null;
                } else {
                    $('[data-field="remote_controller"]').add('active');
                    filter.remote_controller = ($(i.target).data('remote_controller'));
                }

                if ($(i.target).prop("checked")) {
                    $('[data-field="remote_controller"]').addClass('active');
                }
                getData();

                $.each($('.CardFilterCheck input[data-remote_controller]'), (i, e) => {
                    if (this !== e) {
                        e.checked = false;
                    }
                });

            });

            $('.CardFilterCheck input[data-zero_g]').click(function (i) {

                let change = false;

                $.each($('.CardFilterCheck input[data-zero_g]'), function (i, e) {
                    if (change || e.checked) {
                        change = true;
                    }
                });

                if (!change) {
                    $('[data-field="zero_g"]').removeClass('active');
                    filter.zero_g = null;
                } else {
                    $('[data-field="zero_g"]').add('active');
                    filter.zero_g = ($(i.target).data('zero_g'));
                }

                if ($(i.target).prop("checked")) {
                    $('[data-field="zero_g"]').addClass('active');
                }
                getData();

                $.each($('.CardFilterCheck input[data-zero_g]'), (i, e) => {
                    if (this !== e) {
                        e.checked = false;
                    }
                });

            });

            $('.CardFilterCheck input[data-timer]').click(function (i) {

                let change = false;

                $.each($('.CardFilterCheck input[data-timer]'), function (i, e) {
                    if (change || e.checked) {
                        change = true;
                    }
                });

                if (!change) {
                    $('[data-field="timer"]').removeClass('active');
                    filter.timer = null;
                } else {
                    $('[data-field="timer"]').add('active');
                    filter.timer = ($(i.target).data('timer'));
                }

                if ($(i.target).prop("checked")) {
                    $('[data-field="timer"]').addClass('active');
                }
                getData();

                $.each($('.CardFilterCheck input[data-timer]'), (i, e) => {
                    if (this !== e) {
                        e.checked = false;
                    }
                });

            });

            $('.CardFilterCheck input[data-warming_up]').click(function (i) {

                let change = false;

                $.each($('.CardFilterCheck input[data-warming_up]'), function (i, e) {
                    if (change || e.checked) {
                        change = true;
                    }
                });

                if (!change) {
                    $('[data-field="warming_up"]').removeClass('active');
                    filter.warming_up = null;
                } else {
                    $('[data-field="warming_up"]').add('active');
                    filter.warming_up = ($(i.target).data('warming_up'));
                }

                if ($(i.target).prop("checked")) {
                    $('[data-field="warming_up"]').addClass('active');
                }
                getData();

                $.each($('.CardFilterCheck input[data-warming_up]'), (i, e) => {
                    if (this !== e) {
                        e.checked = false;
                    }
                });

            });

            $('.CardFilterCheck input[data-available]').click(function (i) {

                let change = false;

                $.each($('.CardFilterCheck input[data-available]'), function (i, e) {
                    if (change || e.checked) {
                        change = true;
                    }
                });

                if (!change) {
                    $('[data-field="available"]').removeClass('active');
                    filter.available = null;
                } else {
                    $('[data-field="available"]').add('active');
                    filter.available = ($(i.target).data('available'));
                }

                if ($(i.target).prop("checked")) {
                    $('[data-field="available"]').addClass('active');
                }
                getData();

                $.each($('.CardFilterCheck input[data-available]'), (i, e) => {
                    if (this !== e) {
                        e.checked = false;
                    }
                });

            });

            $('.CardFilterCheck input[data-program]').change(function (i) {
                if ($(i.target).prop("checked")) {
                    filter.count_program.push($(i.target).data('program'));
                    $('[data-field="count_program"]').addClass('active');
                    getData();
                } else {
                    filter.count_program.splice(filter.count_program.indexOf($(i.target).data('program')), 1);
                    if (!filter.count_program.length) {
                        $('[data-field="count_program"]').removeClass('active');
                    }
                    getData();
                }
            });

            $('.CardFilterCheck input[data-massage_area]').change(function (i) {
                if ($(i.target).prop("checked")) {
                    filter.massage_area.push($(i.target).data('massage_area'));
                    $('[data-field="massage_area"]').addClass('active');
                    getData();
                } else {
                    filter.massage_area.splice(filter.massage_area.indexOf($(i.target).data('massage_area')), 1);
                    if (!filter.massage_area.length) {
                        $('[data-field="massage_area"]').removeClass('active');
                    }
                    getData();
                }
            });

            $(".CardFilterBtn button").click(function () {
                $(this).parents(".CardFilterBtn").toggleClass("active");

                if ($(this.parentElement).data('field') === 'price') {
                    if ($(this).parents(".CardFilterBtn").hasClass("active")) {
                        filter.price_from = $(".CardFilterPrice").slider("values", 0);
                        filter.price_to = $(".CardFilterPrice").slider("values", 1);
                    } else {
                        filter.price_from = 0;
                        filter.price_to = 0;
                    }
                }

                if ($(this.parentElement).data('field') === 'color') {
                    if ($(this).parents(".CardFilterBtn").hasClass("active")) {

                    } else {
                        filter.color = [];
                    }
                }

                if ($(this.parentElement).data('weight') === 'color') {
                    if ($(this).parents(".CardFilterBtn").hasClass("active")) {

                    } else {
                        filter.weight = [];
                    }
                }

                if ($(this.parentElement).data('field') === 'clear') {
                    $('.CardFilterBtn').removeClass('active');
                    $('.CardFilterCheck input[type="checkbox"]').prop("checked", false);
                    window.filter = {
                        _token: document.head.querySelector('meta[name="csrf-token"]').content,
                        method: '{{$method}}',
                        price_from: 0,
                        price_to: 0,
                        color: [],
                        weight: [],
                        type_controller: [],
                        count_program: [],
                        massage_area: [],
                        remote_controller: null,
                        zero_g: null,
                        warming_up: null,
                        available: null,
                    };
                    getData();
                }

                if ($(this.parentElement).data('field') !== 'clear' || $(this.parentElement).data('field') !== 'color') {
                    getData();
                }

            })
        });
    </script>

    <script>
        $('.filter-button').on('click', function () {
            this.classList.toggle('open');
        });
        $('.CardBox .exemple-image').on('click', function () {

            let id = this.dataset['id'];

            $('.CardBox .exemple-image').removeClass('CardBoxColorActive');
            $(this).addClass('CardBoxColorActive');
            $(this).parents('.CardBox').find('#green_monster').attr('src', $(this).data('big'));

            console.log(id);
            let href = this.parentNode.parentNode.parentNode.querySelectorAll('a[data-id]');
            href.forEach(function (i) {
                if (i.dataset['id'] == id) {
                    i.classList.add('active');
                } else {
                    i.classList.remove('active');
                }

            })

        });

    </script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $(".CardFilterPrice").slider({
                range: true,
                min: 0,
                max: {{$max_price}},
                values: [ {{$min_price}}, {{$max_price}} ],
                slide: function (event, ui) {
                    $("#form-control-1").val(ui.values[0]);
                    $("#form-control-2").val(ui.values[1]);

                    filter.price_from = ui.values[0];
                    filter.price_to = ui.values[1];
                },
                stop: function () {
                    getData();
                }

            });

            $("#form-control-1").val($(".CardFilterPrice").slider("values", 0));
            $("#form-control-2").val($(".CardFilterPrice").slider("values", 1));

            $("#form-control-1").change(function () {
                console.log($(".CardFilterPrice").slider("values", 1));
            });
        });
    </script>
@stop

@section('content')
    <div class="CategoryTop" style="background-image: url('{{$rubric->getThumb()}}')">
        <h1>{{$rubric->name}}</h1>
    </div>
    <div class="Card CardTpl">

        @mobile
        <div class="filter-button">
            <svg style="width: 20px; height: 20px; margin-right: 10px" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="20" viewBox="0 0 22 20">
                <g>
                    <g>
                        <image width="22" height="20"
                               xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAUCAYAAACJfM0wAAACeklEQVQ4T62UX0hUQRTGv3O7aREVSBRUIJGYlbBGZDtrgRT0FBHCvUsPvRSRsyIY1FuRUC8FQZHurL5EPbl3EQMfIoj+UO3dlSAjKjOsqCCigiiCLPeemLurqO3e1JqXGWbm+83MOd8ZErZ8DKAS+ba40M+1+1YQfiJhy1EAZYWJrwCWzJH6HcCicS3VR1uq57E3BIBAfMFNJtqEdbAiN7aAZnrAQF/n57DdfJJA7VpjGN4WXyyizbvB1K/HHtP2bCp+b6ZQvS9ixeqYeADAfCLel04meiZuJWzZAqAjD/c2ZlNdT2cC39rUutowx14BMBk4nXHUCa2b8lwRlVfA2A/gTfnP8tDtq+e//A0ubPkCQBWAftdReyZiPF0obPkAwGYAg66jNgWBhSWvg7ALwHPXUTWT9/6RIGEdWQj68Q5ABQOXMo46UAwuovIsGMcA/DLZXHU3dfFjIFgvboseDuXYGMzHio+mncS5yaKIHTvE4G5/zqAGtyeenn54SUsJW+4F0OfDmXemU4mbetwQlWGP4eoxAzLjqESxFwV6NWzLUwQcJ2A47ah1vjXzlVoLog43GW8tlYNA8AbLKltKy3RlvncdtTLv+dgzMNd4Oa8629ulHVG0BYILHn0Lwks3qdYWbvwQQB0bRjjT05mdEzjS1FLJpvcawIjrKO1VHQofXCppJX08JftFwGFbDhIQ+j/gqaHQz68n9iLpVJfvjlm7YiIUjCduStU2Nrabo8s/DANYY4B23Hfit/4NTDQEz7sMMtoAXuHDcrn1bm+3/m5nf2NhxapAPN1Sd5hwJpNU10pB/aIKWizYTReECeARA+0ZR90I0oyv/Qa8Q/QQp6Q82QAAAABJRU5ErkJggg=="/>
                    </g>
                </g>
            </svg>
            Фильтровать
        </div>
        <div class="filter-container">
            @endmobile

            <ul class="CardFilter">
                @if(in_array('price',$filter))
                    <li class="CardFilterBtn" data-field="price">
                        <button>Цена</button>
                        <ul>
                            <li>
                                <div class="CardFilterPriceTop">
                                    <label>
                                        <span>От</span>
                                        <input type="text" id="form-control-1" class="form-control"
                                               value="{{$min_price}}">
                                    </label>
                                    <b>-</b>
                                    <label>
                                        <span>До</span>
                                        <input type="text" id="form-control-2" class="form-control"
                                               value="{{$max_price}}">
                                    </label>
                                </div>
                                <div class="CardFilterPrice"></div>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('color',$filter))
                    <li class="CardFilterBtn" data-field="color">
                        <button>Цвет</button>
                        <ul>
                            @foreach($colors as $color)
                                <li>
                                    <label class="CardFilterCheck">
                                        <input type="checkbox" required="required" data-color="{{$color->color}}">
                                        <span>{{__('color.'.$color->color)}}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
                @if(in_array('weight',$filter))
                    <li class="CardFilterBtn" data-field="weight">
                        <button>Вес</button>
                        <ul>
                            @foreach($weights as $weight)
                                <li>
                                    <label class="CardFilterCheck">
                                        <input type="checkbox" required="required" data-weight="{{$weight->weight}}">
                                        <span>{{$weight->weight}} кг</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
                @if(in_array('remote_controller',$filter))
                    <li class="CardFilterBtn" data-field="remote_controller">
                        <button>Пульт</button>
                        <ul>
                            <li>
                                <label class="CardFilterCheck">
                                    <input type="checkbox" name="remote_controller" required="required"
                                           data-remote_controller="1">
                                    <span>Да</span>
                                </label>
                            </li>
                            <li>
                                <label class="CardFilterCheck">
                                    <input type="checkbox" name="remote_controller" required="required"
                                           data-remote_controller="0">
                                    <span>Нет</span>
                                </label>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(in_array('zero_g',$filter))
                    <li class="CardFilterBtn" data-field="zero_g">
                        <button>Zero-G</button>
                        <ul>
                            <li>
                                <label class="CardFilterCheck">
                                    <input type="checkbox" name="zero_g" required="required"
                                           data-zero_g="1">
                                    <span>Да</span>
                                </label>
                            </li>
                            <li>
                                <label class="CardFilterCheck">
                                    <input type="checkbox" name="zero_g" required="required"
                                           data-zero_g="0">
                                    <span>Нет</span>
                                </label>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(in_array('warming_up',$filter))
                    <li class="CardFilterBtn" data-field="timer">
                        <button>Таймер</button>
                        <ul>
                            <li>
                                <label class="CardFilterCheck">
                                    <input type="checkbox" name="timer" required="required"
                                           data-timer="1">
                                    <span>Да</span>
                                </label>
                            </li>
                            <li>
                                <label class="CardFilterCheck">
                                    <input type="checkbox" name="timer" required="required"
                                           data-timer="0">
                                    <span>Нет</span>
                                </label>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(in_array('type_controller',$filter))
                    <li class="CardFilterBtn" data-field="type_controller">
                        <button>Управление</button>
                        <ul>
                            <li>
                                <label class="CardFilterCheck">
                                    <input type="checkbox" required="required" data-type_controller="auto">
                                    <span>Автоматическое</span>
                                </label>
                            </li>
                            <li>
                                <label class="CardFilterCheck">
                                    <input type="checkbox" required="required" data-type_controller="manual">
                                    <span>Ручное</span>
                                </label>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(in_array('sub_type_of_product',$filter))
                    <li class="CardFilterBtn" data-field="sub_type_of_product">
                        <button>Тип товара</button>
                        <ul>
                            <li>
                                <label class="CardFilterCheck">
                                    <input type="checkbox" required="required" data-sub_type_of_product="candles">
                                    <span>Свечи</span>
                                </label>
                            </li>
                            <li>
                                <label class="CardFilterCheck">
                                    <input type="checkbox" required="required" data-sub_type_of_product="soap">
                                    <span>Мыло</span>
                                </label>
                            </li>
                            <li>
                                <label class="CardFilterCheck">
                                    <input type="checkbox" required="required"
                                           data-sub_type_of_product="perfume for home">
                                    <span>Парфюм для дома</span>
                                </label>
                            </li>
                            <li>
                                <label class="CardFilterCheck">
                                    <input type="checkbox" required="required" data-sub_type_of_product="bath bombs">
                                    <span>Бомбы для ванн</span>
                                </label>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(in_array('count_program',$filter) && $programs)
                    <li class="CardFilterBtn" data-field="count_program">
                        <button>Программы</button>
                        <ul>
                            @foreach($programs as $program)
                                <li>
                                    <label class="CardFilterCheck">
                                        <input type="checkbox" required="required"
                                               data-program="{{$program->count_program}}">
                                        <span>{{$program->count_program}}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
                @if(in_array('warming_up',$filter))
                    <li class="CardFilterBtn" data-field="warming_up">
                        <button>Прогрев</button>
                        <ul>
                            <li>
                                <label class="CardFilterCheck">
                                    <input type="checkbox" name="warming_up" required="required"
                                           data-warming_up="1">
                                    <span>Да</span>
                                </label>
                            </li>
                            <li>
                                <label class="CardFilterCheck">
                                    <input type="checkbox" name="warming_up" required="required"
                                           data-warming_up="0">
                                    <span>Нет</span>
                                </label>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(in_array('available',$filter))
                    <li class="CardFilterBtn" data-field="available">
                        <button>Наличие</button>
                        <ul>
                            <li>
                                <label class="CardFilterCheck">
                                    <input type="checkbox" name="available" required="required"
                                           data-available="1">
                                    <span>Да</span>
                                </label>
                            </li>
                            <li>
                                <label class="CardFilterCheck">
                                    <input type="checkbox" name="available" required="required"
                                           data-available="0">
                                    <span>Нет</span>
                                </label>
                            </li>
                        </ul>

                    </li>
                @endif

                @if(in_array('massage_area',$filter) && $massage_areas )
                    <li class="CardFilterBtn" data-field="massage_area">
                        <button>Область</button>
                        <ul>
                            @foreach($massage_areas as $massage_area)
                                <li>
                                    <label class="CardFilterCheck">
                                        <input type="checkbox" required="required"
                                               data-massage_area="{{$massage_area}}">
                                        <span>{{$massage_area}}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
                @if($filter)
                    <li class="CardFilterBtn" data-field="clear">
                        <button onclick="location.reload()" >Очистить</button>
                    </li>
                @endif
            </ul>
            @mobile
        </div>
        @endmobile
        <ul class="FilterSort">
            @if($filter)

                <li>Сортировать:</li>
                <li><a href="#" class="active" data-sort="name">По названию</a></li>
                <li><a href="#" data-sort="price">По цене</a></li>
                {{--            <li><a href="#">По популярности</a></li>--}}
            @endif
        </ul>

        <div class="container" id="container">
            <div class="container sixteen columns">
                <div class="CardWr">
                    @foreach($products as $product)
                        <div class="CardBox">
                            <div class="CardDiscount">
                                @foreach($product->getTags() as $tag)
                                    @switch($tag->data->keyword )
                                        @case('new')
                                        <span class="item-new">new</span>
                                        @break
                                        @case('hit')
                                        <span class="item-hits">хит</span>
                                        @break
                                    @endswitch
                                @endforeach

                                @if($product->discount)
                                    <span class="item-disc">-{{$product->discount}}%</span>
                                @endif
                            </div>
                            <div class="CardBoxImg">
                                <img id="green_monster" src="{{$product->getBackground()}}"
                                     data-big="{{$product->getBackground()}}">
                                @if($product->present)
                                    <i class="CardBoxImgGift" title="{{$product->present}}">
                                        <img src="/img/Layer_2_copy.png" alt="{{$product->present}}">
                                    </i>
                                @endif
                            </div>
                            <div class="CardBoxDesc">
                                <div class="CardBoxColor">
                                    @if($product->type_of_product == 'massage_chairs' )
                                        <i class="exemple-image color-{{$product->color}} CardBoxColorActive"
                                           data-big="{{$product->getBackground()}}" data-id="{{$product->id}}"></i>

                                        @foreach($product->getChild() as $img)
                                            <i class="exemple-image color-{{$img->color}}"
                                               data-big="{{$img->getBackground()}}" data-id="{{$img->id}}"></i>
                                        @endforeach
                                    @endif
                                </div>
                                <p>{{$product->getType()}}</p>
                                <h5>{{$product->name}}</h5>
                                <div class="CardBoxPrice">
                                    <span>{{$product->getPrice()}} <b>тг</b></span>
                                    @if($product->getOldPrice())
                                    <span>{{$product->getOldPrice()}} <b>тг</b></span>
                                    @endif
                                    <button data-id="{{$product->id}}"
                                            class="{{( in_array($product->id,$liked) ?'CardBoxPriceLiked':'CardBoxPriceLike')}}"></button>
                                </div>
                            </div>
                            <a data-id="{{$product->id}}" class="active" href="{{$product->getUrl()}}"></a>
                            @foreach($product->getChild() as $img)
                                <a data-id="{{$img->id}}" href="{{$img->getUrl()}}"></a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            @if($products->hasPages())
                {!! $products->render() !!}
            @endif
        </div>
    </div>

    <div class="IndexBull IndexBullForm">
        <ul class="IndexBullWr">
            <li class="IndexBull-item">
                <a href="/sales/">
                    <span>Скидки и бонусы</span>
                    <img src="/img/icon/podarok.png">
                </a>
            </li>
            <li class="IndexBull-item">
                <span>Будьте в курсе всех новостей!</span>
                <form id="IndexBullSubs" action="">
                    <input type="email" class="text" placeholder="E-mail">
                    <button type="submit" class="IndexBullBtn">Подписаться</button>
                    <label class="IndexBullCheckbox">
                        <input type="checkbox" required="required" checked="">
                        <span>Соглашаюсь с условиями <a target="_blank"
                                                        href="/img/оферта.pdf">договора оферты</a></span>
                    </label>
                </form>
                <img src="/img/Vector_Smart_Object.png">
            </li>
        </ul>
    </div>
@endsection
