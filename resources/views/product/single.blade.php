@extends('layouts.app')

@section('title')
    {{$rubric->name}} {{$object->name}}
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="/css/main-style.css" type="text/css"/>
    <link rel="stylesheet" href="/css/product-post.css" type="text/css"/>
@stop

@section('script')
    @parent

    <script>

        let button_submit = document.querySelector('#submit');

        window.product_ = {id:{{$object->id}}, price:{{$object->price}}, count: 1};
        window.current_count = 1;
        input_count = document.querySelector('#count');
        if (input_count)
            input_count.addEventListener('change', function () {
                current_count = parseInt(this.value);
                if (!this.value) {
                    this.value = 1;
                }
            });


        if (button_submit)
            button_submit.addEventListener('click', function () {
                product_.count = window.current_count;
                let product = product_;
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

            $('.CardBoxPriceLiked').on('click', function () {
                return false;
            });

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
                </div>
                @if($present)
                    <br>
                    <p>{{$present->description}}</p>
                    <br>
                @endif
            </div>
            <div class="ProdPostCardLBottom">
                <a data-id="{{$object->id}}"
                   class="{{( in_array($object->id,$liked) ?'CardBoxPriceLiked':'CardBoxPriceLike')}}" href="#">
                    в избранное</a>
                @if($object->type_of_product == 'massage_chairs')
                    <a href="#" data-comparison="{{$object->id}}">к сравнению</a>
                @endif
                @if($object->brochure)
                    <a href="{{$object->brochure}}" target="_blank">брошюра</a>
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
                    <td class="name-field">Тип управления::</td>
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
                    <td class="name-field">Область массажа:</td>
                    <td class="value-field">
                        {{$object->massage_area}}
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
