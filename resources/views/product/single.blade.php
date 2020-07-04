@extends('layouts.app')

@section('title')
    {{$rubric->name}} {{$object->name}}
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="/css/main-style.css?v=6" type="text/css"/>
    <link rel="stylesheet" href="/css/product-post.css?v=6" type="text/css"/>
    <style>
        .icons-container {
            display: grid;
            grid-template-columns: repeat(3, 60px);
            grid-gap: 20px;
            justify-content: flex-start;
            align-content: center;
            align-items: center;
        }
    </style>
    @if($object->custom_style)
        <style>
            {!! $object->custom_style !!}
        </style>
    @endif
@stop

@section('script')
    @parent

    <script>

        let button_submit = document.querySelector('#submit');

        window.product_ = {id:{{$object->id}}, price:{{$object->price}}, count: 1};
        window.current_count = 1;
        input_count = document.querySelector('#count');
        if (input_count) {
            input_count.addEventListener('change', function () {
                window.current_count = parseInt(this.value);
                if (!this.value) {
                    this.value = 1;
                }
                console.log(this.value);
            });
        }


        if (button_submit)
            button_submit.addEventListener('click', function () {

                window.current_count = parseInt(input_count.value);

                window.product_.count = window.current_count;

                let product = window.product_;
                let basket = JSON.parse(localStorage.getItem('basket'));
                let concat = false;

                if (basket) {
                    for (let i = 0; i < basket.length; i++) {
                        if (basket[i].id === product.id) {
                            basket[i].count = parseInt(basket[i].count) + parseInt(product.count);
                            concat = true;
                        }
                    }
                    if (!concat) {
                        basket.push(product);
                    }
                    localStorage.setItem('basket', JSON.stringify(basket));
                    UIkit.notification({message: 'Товар успешно добавлен в корзину!', status: 'success'});
                } else {
                    basket = [];
                    basket.push(product);
                    localStorage.setItem('basket', JSON.stringify(basket));
                    UIkit.notification({message: 'Товар успешно добавлен в корзину!', status: 'success'});
                }
                input_count.value = 1;
            });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {

            $('.CardBoxPriceLike').on('click', sendToSelect);
            $('.CardBoxPriceLiked').on('click', sendToSelect);

            // $('.CardBoxPriceLiked').on('click', function () {
            //     return false;
            // });

            $('.minus').click(function () {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                return false;
            });
            $('.plus').click(function () {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });

            $("[data-comparison]").click(function () {
                event.preventDefault();

                let comparison = JSON.parse(localStorage.getItem('comparison'));
                if (comparison) {
                    if (comparison.indexOf(this.dataset['comparison']) < 0) {
                        comparison.push(this.dataset['comparison']);
                    }
                } else {
                    comparison = [];
                    comparison.push(this.dataset['comparison']);
                }
                localStorage.setItem('comparison', JSON.stringify(comparison));

                location.href = '/product-comparison';
                return false;
            });
        });
    </script>

    <script>
        $('.ProdPostSlider').slick({
            infinite: true,
            arrows: false,
            dots: true,
            centerPadding: 20,
            slidesToShow: 1
        });
    </script>

    <script>
        $('.ProdImageSliderImg').slick({
            infinite: true,
            arrows: true,
            dots: false,
            centerPadding: 20,
            slidesToShow: 1
        });
    </script>

    <script>
        $('.ProdCardWr').slick({
            infinite: true,
            arrows: true,
            dots: false,
            centerPadding: 20,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [

                {
                    breakpoint: 980,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 709,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    </script>

    <script>
        $('.CardWr').slick({
            infinite: true,
            arrows: true,
            dots: false,
            centerPadding: 20,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [

                {
                    breakpoint: 980,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 709,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    </script>

    <script>
        $(function () {
            $(".ProdPlusCircle").click(function () {
                $('.ProdPlusCircle').not(this).removeClass('active');
                $(this).toggleClass("active");

            })
        });
    </script>

    <script>
        $('.CardBox .exemple-image').on('click', function () {
            $('.CardBox .exemple-image').removeClass('CardBoxColorActive');
            $(this).addClass('CardBoxColorActive');
            $(this).parents('.CardBox').find('#green_monster').attr('src', $(this).data('big'));
        });
    </script>
@stop

@section('content')
    <div class="ProdPostCard">
        <div class="ProdPostCardL">
            <ul class="ProdCrumbs">
                <li><a href="/">Главная</a></li>
                <li>&nbsp;/&nbsp;</li>
                <li><a href="/{{$rubric->slug}}/"> {{$rubric->name}}</a></li>
            </ul>
            <h1>{{$object->name}}</h1>
            @if(in_array($object->type_of_product,['massage_chairs']))
                <div class="icons-container">
                    <img src="/img/icon/icon_iso_(1).png" alt="">
                    <img src="/img/icon/german_quality_(1).png" alt="">
                    <img src="/img/icon/icon_5years_(1).png" alt="">
                </div>
            @endif
            <div clas="ProdPostVarWr">
                @if($brand = $object->getBrand() )
                    <div class="ProdPostVar">
                        <span>Бренд:</span>
                        <img class="ProdPostVarImg" src="{{$brand->getThumb()}}">
                    </div>
                @endif
                @if(in_array($object->type_of_product,['massage_chairs']))
                    <div class="ProdPostVar">
                        <span>Цвет:</span>
                        <div class="ProdPostVarColor">
                            @foreach($object->getColors() as $color)
                                <a href="{{$color->getUrl()}}"
                                   class="color-{{$color->color}} {{($color->color==$object->color?'active':'')}}"><input
                                        type="radio" name="color"><i></i></a>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="ProdPostVar">
                    <span>Количество:</span>
                    <div class="ProdPostVarCount">
                        <input type="number" id="count" name="count" value="1"/>
                        <span class="plus">&#9650;</span>
                        <span class="minus">&#9660;</span>
                    </div>
                </div>
                <div class="ProdPostVar">
                    <span>Стоимость:</span>
                    <div class="ProdPosrVarPrice">
                        @if($object->discount)
                            <b>{{number_format($object->price-($object->price/100*$object->discount),0,'.',' ')}} тг</b>
                            <i class="item-disc">-{{$object->discount}}%</i>
                            <strong>{{number_format($object->price,0,'.',' ')}}</strong>
                        @else
                            <b>{{number_format($object->price,0,'.',' ')}} тг</b>
                        @endif
                    </div>
                </div>
                <div class="ProdPostVarSubmit">
                    <button id="submit" class="SiteBtn" type="submit">В корзину</button>
                    @if( $present = $object->present())
                        <div class="ProdPostGift" title="{{$present->name}}">
                            <i class="item-gift">
                                <img width="30" src="{{$present->image}}" alt="{{$present->name}}">
                            </i>
                            <span>подарок</span>
                        </div>
                    @endif
                    @if( $object->caspian_link)
                        <a href="{{$object->caspian_link}}"  target="_blank" class="SiteBtn SiteBtnCaspi" type="button"><svg style="margin-right: 10px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" viewBox="0 0 25 25"><g><g><image width="25" height="25" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAZCAYAAADE6YVjAAAGAUlEQVRIS32WC2wUVRSG/zuvne5sd5GWAhVFMT7AByJCeIhKgBaoDSJtLDTlESBaFkvQQpX4qCKoIESM1kp4KBSoYFFYFCGoBUECGI1IIBqtAm1pabvd7u7MvmbuNTOl2y6l3GSTnTP33u+cc/9z7hDcZDCANM/KeoToxhQurD3G6bE7iK4nM57XGSG1TBDPxZyug0YbDqd7PFpPW5GeXjTkZ4+S/L53hZD2BCJhEEEA43iA5wDGQBgDqOkGYIi2Bt3p+iBlyOi1pLSUXr/nDSFXcya9K/u8xUSP8caVOkBxgMgy4HB288mEEUYBSqEryWciffs922/Tnn+7TkyA1LrdKfa68ztFX0sGk2ygAT+k6XkQJ2Yh9u1XiFUfBjiuxwRzegxUkr1ar9QZ/SsPVHdMTIB4pz15XGxrHUslCYhGIYzPgP31Ndbc0DuvIvbDdzeFmPM4wwDjODU8IXNy2surjpu2OKS5aN57tt9OLadJSrsDahByyUpI2TOgnzwGdfFskNS0G0cRi4G1toA4XYCcBGKCBPGK69Cp9DjkyvurhyieylNMlh3moZqD1V6E7cXXIM9fjOCiAhhHD4MMGNgdQg0wbwv4YSPBWprANBXQVLCLNTAmTl6XsvXrYiuS5rysMqm5oZB15FvXwfVLh1K+EyTZaW2iLnsO9L8aQBDiIEIImKYh6c11EMdnILK1zPqZQjFtoaUL/Oqjjz9oQdomPBIkPKewa9kjHIekt9ZDGDEmvqFx/iy0FxeCXYvUehGNQJz0FJJWrLIeA7mTYFw4B8eOAxCGDod/zH2IPjSskDQWu0fbzxz7mdrkTg+dLigbtoBLvy0hPcGZU0G9zZ22SBhihglZjeiBKmgli6GUV0AcNwGhDasR81TB6NNvN/HOmfaRUHvZzXg+vpi7JQXKx9tBUlITINH9e6C6C8CZAmAMzN8GMTvHckj/7Qy4lD7gbr8D0aodCK0tBderN6jD+TfxZY87z4VDgxnpVDPX6xYoW/eC2K8prQvKlLLxz18wU8oPHW4Jw1RUx4h6voS2vBBc/1sBUbLOkLROHN7Mc1xKu6baBz9wEJSNlTeW602s9NK/CMycCqIoALlWtJSC+KaM+pvT9bvikUTCsC0sgi1/QbftzPTEjnwLLn0AhJFjuxVm7OA+hFavALpmgOdBWgumVfD1l/PjZ6KplrLE8ZndIGrRPKu9QJYtiP3tDRawY+gnfoT2RjHQ5XyZ4qgjTUvnZ8u/nt4fV5cVyRLY8ucnQMwogs9mgtH2ZmgWnm1BEeRFL3WR+R/QSgrBolHLZjZPI/3WbwjbncsHNtbo8UJkDPzdg6F8vC0BQusvQ31hLlgw0G6nFMKwEbCv+SQ+j6lBBGdlwbwazHoyIdE77y6xJNWSM2mP6PPmdIBMCTsqPAnVTWsvQV0yrxPCGLi+/eHYvj/BGW3FC1avg00GiYTV0NCRYyxIfcmSxx2nqw8xySab+rfqpGw7kGRH7Nj3kDKzQesuQy3qEgkYWDgC19GzFiRS+RlseXPBvM1oGzsYfGoaYoPu2Zuy7esZ8eJomZm1V7pUM50qDlh1Ur4Txn81iJSvt/7T+trrIAC72gDnyT9BbDLaHr4NtqKXrboJrV+JSMVmGluw3JXmdgfjEFZaKvh/OXKR+H3ppP8AOLZUIVp9CNGKTXBs3wfaeCXxTMxO7WuFsnkPhHvvRyBnAsAAx7Z9AKNG4IfDBa6cWbssAXRNaFPZB/eKRzzf8AR3Ob48gqinCuGytXB6fgJtaYLqng0W8HcuUQOQX1kFKesZBKaMBmuog31jpdlY5xBC4srpdse3fFjqlAXnTnvh0qzYiWpoS+fDdeICWCCA4HN5Vr+Kj5AGqWAh5IVLoBY/D/3MiWZlw9ZccdiI+NXbLZKOxWz3bh65ufm0qfGd4NNPpjurf7f6kD9zpPXRwCgDoQZoYwMk9zIkLXrJoFcbd3k/Ky/pU1Jaf30V9/hJZE5kjCmBLR/lJc9dlAGOeyBSsSk18nl5EiSJQRB9pFfv2uR1n36H1LQvCCF/9dTW/gfrH5vK5H1aMgAAAABJRU5ErkJggg=="/></g></g></svg> в рассрочку</a>
                    @endif
                </div>
                @if($present)
                    <br>
                    <p>{{$present->description}}</p>
                    <br>
                @endif
            </div>
            <div class="ProdPostCardLBottom">
                <a data-to-favorites="" data-id="{{$object->id}}"
                   class="{{( in_array($object->id,$liked) ?'CardBoxPriceLiked':'CardBoxPriceLike')}}" href="#">
                    в избранное</a>
                @if($object->type_of_product == 'massage_chairs')
                    <a href="/product-comparison" >к сравнению</a>
                @endif
                @if($object->brochure)
                    <a href="{{$object->brochure}}" target="_blank">Инструкции</a>
                @endif
            </div>
        </div>
        <div class="ProdPostCardR">
            <div class="ProdPostSlider">
                @foreach($object->getImages() as $item)
                    <div class="ProdPostSliderImg" style="background-image:  url({{$item->image}});"></div>
                @endforeach
            </div>
        </div>
    </div>

    {!! $object->description !!}

    @if(in_array($object->type_of_product,['massage_chairs','massagers','fitness_equipment']))

        <div class="Specifications">
            <div class="Specifications-title">Технические характеристики:</div>
            <table>
                <thead>
                <tr>
                    <th class="name-field">&nbsp;</th>
                    <th class="value-field">{{$object->name}}</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="name-field">Цвет:</td>
                    <td class="value-field">
                        @foreach($object->getColors() as $color)
                            <span
                                class="color-{{$color->color}} {{($color->color==$object->color?'active':'')}}"></span>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Вес:</td>
                    <td class="value-field">
                        {{$object->weight}} кг
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Пульт дист. управления:</td>
                    <td class="value-field">
                        {{($object->remote_controller?"+":"-")}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Панель управления:</td>
                    <td class="value-field">
                        {{($object->control_panel?"+":"-")}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Запоминание пользователя:</td>
                    <td class="value-field">
                        {{($object->user_memorization?"+":"-")}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Система Zero-G:</td>
                    <td class="value-field">
                        {{($object->zero_g?"+":"-")}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Таймер:</td>
                    <td class="value-field">
                        {{($object->timer?"+":"-")}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Тип управления:</td>
                    <td class="value-field">
                        {{__('site.'.$object->type_controller)}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Кол-во программ:</td>
                    <td class="value-field">
                        {{$object->count_program}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Прогрев:</td>
                    <td class="value-field">
                        {{($object->warming_up?"+":"-")}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Синхронизация с музыкой:</td>
                    <td class="value-field">
                        {{($object->sync_with_music?"+":"-")}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Bluetooth:</td>
                    <td class="value-field">
                        {{($object->bluetooth?"+":"-")}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Регулировка интенсивности массажа:</td>
                    <td class="value-field">
                        {{($object->massage_intensity_adjustment?"+":"-")}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Регулировка скорости массажа:</td>
                    <td class="value-field">
                        {{($object->massage_speed_adjustment?"+":"-")}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Ручное отключение:</td>
                    <td class="value-field">
                        {{($object->manual_shutdown?"+":"-")}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Автоматическое отключение:</td>
                    <td class="value-field">
                        {{($object->auto_shut_off?"+":"-")}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Антистресс система Braintronics:</td>
                    <td class="value-field">
                        {{($object->antistress_system_braintronics?"+":"-")}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Число роликов в области спины:</td>
                    <td class="value-field">
                        {{$object->number_rollers_back}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Число роликов в области ступней:</td>
                    <td class="value-field">
                        {{$object->number_rollers_foot}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Общее число воздушных подушек:</td>
                    <td class="value-field">
                        {{$object->number_airbags}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Тип каретки:</td>
                    <td class="value-field">
                        {{$object->carriage_type}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Длина каретки:</td>
                    <td class="value-field">
                        {{$object->carriage_length}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Область массажа:</td>
                    <td class="value-field">
                        {{$object->massage_area}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Виды массажа:</td>
                    <td class="value-field">
                        {{$object->type_massage}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Максимальный вес пользователя:</td>
                    <td class="value-field">
                        {{$object->maximum_user_weight}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Угол наклона спинки:</td>
                    <td class="value-field">
                        {{$object->backrest_angle}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Угол наклона подножки:</td>
                    <td class="value-field">
                        {{$object->footrest_tilt_angle}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Минимальное расстояние от стены:</td>
                    <td class="value-field">
                        {{$object->minimum_distance_wall}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Основное напряжение:</td>
                    <td class="value-field">
                        {{$object->main_voltage}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Частота:</td>
                    <td class="value-field">
                        {{$object->frequency}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Габариты:</td>
                    <td class="value-field">
                        {{$object->dimensions}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Гарантия производителя:</td>
                    <td class="value-field">
                        {{$object->manufacturer_warranty}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Наличие:</td>
                    <td class="value-field">
                        {{($object->available?"+":"-")}}
                    </td>
                </tr>
                <tr>
                    <td class="name-field">Цена:</td>
                    <td class="value-field">
                        {{number_format($object->price,0,","," ")}}
                    </td>
                </tr>

                </tbody>
            </table>
        </div>

    @endif

    <div class="IndexBull">
        <ul class="IndexBullWr">
            @php
                $slider = \App\Slider::where('id',3)->first();
                $items = ($slider?$slider->getItemsWithPhoto():[]);
            @endphp
            @foreach($items as $item)
                <li class="IndexBull-item">
                    <a href="#">
                        <span>{{$item->title}}</span>
                        <img src="{{$item->data['desktop']->image}}">
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    @php
        $bestsellers = \App\Product::getBestsellers(8);
    @endphp
    @if($bestsellers)
        <div class="Card">
            <div class="container">
                <div class="container sixteen columns">
                    <h3 class="title-text">Хиты продаж:</h3>

                    <div class="CardWr">
                        @foreach($bestsellers as $product)
                            <div class="CardBox">
                                <div class="CardDiscount">
                                    <span class="item-hits">хит</span>
                                </div>
                                <div class="CardBoxImg">
                                    <img id="green_monster" src="{{$product->getBackground()}}"
                                         data-big="{{$product->getBackground()}}">
                                </div>
                                <div class="CardBoxDesc">
                                    <div class="CardBoxColor">
                                        {{--                                        @foreach($product->getChild() as $img)--}}
                                        {{--                                            <i class="exemple-image" data-big="{{$img->getBackground()}}"></i>--}}
                                        {{--                                        @endforeach--}}
                                    </div>
                                    <p>{{$product->getType()}}</p>
                                    <h5>{{$product->name}}</h5>
                                    <div class="CardBoxPrice">
                                        <span>{{$product->price}} <b>тг</b></span>
                                        <button data-id="{{$product->id}}"
                                                class="{{( in_array($product->id,$liked) ?'CardBoxPriceLiked':'CardBoxPriceLike')}}"></button>
                                    </div>
                                </div>
                                <a href="{{$product->getUrl()}}"></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

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
