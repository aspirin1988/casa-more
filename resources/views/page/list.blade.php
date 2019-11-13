@extends('layouts.app')

@section('title')
    {{$title ?? 'Каталог'}} || Casa & More
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="/css/main-style.css" type="text/css"/>
    <link rel="stylesheet" href="/css/index.css" type="text/css"/>
    <link rel="stylesheet" href="/css/catalog.css" type="text/css"/>
@stop

@section('script')
    @parent
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

                if ($(this.parentElement).data('field') !== 'clear' || $(this.parentElement).data('field') !== 'color') {
                    getData();
                }

            })
        });
    </script>

    <script>
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
@stop

@section('content')
    <div class="CategoryTop">
        <h1>Новости</h1>
    </div>
    <div class="Card CardTpl">
        <div class="container" id="container">
            <div class="container sixteen columns">
                <div class="CardWr">
                    @foreach($pages as $product)
                        <div class="CardBox">
                            <div class="CardDiscount">
                            </div>
                            <div class="CardBoxImg">
                                <img id="green_monster" src="{{$product->getThumb()}}"
                                     data-big="{{$product->getThumb()}}">
                            </div>
                            <div class="CardBoxDesc">
                                <div class="CardBoxColor">
                                </div>
                                <h5>{{$product->name}}</h5>
                                <div class="CardBoxPrice">
                                </div>
                            </div>
                            <a data-id="{{$product->id}}" class="active" href="{{$product->getUrl()}}"></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="IndexBull IndexBullForm">
        <ul class="IndexBullWr">
            <li class="IndexBull-item">
                <a href="#">
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
