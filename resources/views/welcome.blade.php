@extends('layouts.app')

@section('styles')
    @parent
    <link rel="stylesheet" href="/css/index.css" type="text/css"/>
@stop

@section('script')
    @parent
    <script>
        $(document).ready(function () {
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


            setTimeout(function () {
                var style = document.createElement('style');
                document.head.appendChild(style);
                style.sheet.insertRule('.tab-form {display: none;}');
            }, 1000);
        });
    </script>

@stop
@section('content')
    @php
        $slider = \App\Slider::where('id',1)->first();
        $items = ($slider?$slider->getItemsWithPhoto():[]);
    @endphp
    <div class="IndexTopSlid">
        <div class="IndexTop owl-carousel">
            @foreach($items as $item)
                <div>
                    <div class="cover" style="background: {{$item->color}}"></div>
                    <div class="container">
                        <div class="container sixteen columns">
                            <div class="IndexTopWr">
                                <div class="IndexTopTpl">
                                    <h2>{{$item->title}}</h2>
                                    <p>{{$item->description}}</p>
                                    <a href="{{$item->link}}" class="SiteBtn">Подробнее</a>
                                    <div class="IndexTopTplImg">
                                        <img src="{{$item->data['desktop']->image}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="IndexCategory">
        <div class="container">
            <div class="container sixteen columns">

                <h3 class="title-text">Каталог товаров:</h3>

                <div class="IndexCategoryBody">
                    @php
                        $slider = \App\Slider::where('id',2)->first();
                        $items = ($slider?$slider->getItemsWithPhoto():[]);
                    @endphp
                    @foreach($items as $item)
                        <a class="IndexCategoryBodyBl" href="{{$item->link}}">
                            <h2>{{$item->title}}</h2>
                            <p>{{$item->description}}</p>
                            <div class="IndexCategoryBodyBlImg"
                                 style="background: url({{$item->data['desktop']->image}}) center center no-repeat;"></div>
                        </a>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <div class="IndexBull">
        <ul class="IndexBullWr">
            @php
                $slider = \App\Slider::where('id',3)->first();
                $items = ($slider?$slider->getItemsWithPhoto():[]);
            @endphp
            @foreach($items as $item)
                <li class="IndexBull-item">
                    <a href="{{$item->link}}">
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
                                        @if(in_array($product->type_of_product,['massage_chairs']))
                                            <i class="exemple-image color-{{$product->color}} CardBoxColorActive"
                                               data-big="{{$product->getBackground()}}" data-id="{{$product->id}}"></i>
                                        @endif
                                        {{--                                        @foreach($product->getChild() as $img)--}}
                                        {{--                                            <i class="exemple-image color-{{$img->color}}"--}}
                                        {{--                                               data-big="{{$img->getBackground()}}" data-id="{{$img->id}}"></i>--}}
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
                                <a class="active" data-id="{{$product->id}}" href="{{$product->getUrl()}}"></a>
                                {{--                                @foreach($product->getChild() as $img)--}}
                                {{--                                    <a data-id="{{$img->id}}" href="{{$img->getUrl()}}"></a>--}}
                                {{--                                @endforeach--}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    @php
        $new_items = \App\Product::getNewItems(8);
    @endphp
    @if($new_items)
        <div class="Card CardNew">
            <div class="container">
                <div class="container sixteen columns">
                    <h3 class="title-text">Новинки:</h3>
                    <div class="CardWr">
                        @foreach($new_items as $product)
                            <div class="CardBox">
                                <div class="CardDiscount">
                                    <span class="item-new">new</span>
                                </div>
                                <div class="CardBoxImg">
                                    <img id="green_monster" src="{{$product->getBackground()}}"
                                         data-big="{{$product->getBackground()}}">
                                </div>
                                <div class="CardBoxDesc">
                                    <div class="CardBoxColor">
                                        @if(in_array($product->type_of_product,['massage_chairs']))
                                            <i class="exemple-image color-{{$product->color}} CardBoxColorActive"
                                               data-id="{{$product->id}}"
                                               data-big="{{$product->getBackground()}}"></i>
                                        @endif
                                        {{--                                        @foreach($product->getChild() as $img)--}}
                                        {{--                                            <i class="exemple-image color-{{$img->color}}" data-id="{{$img->id}}"--}}
                                        {{--                                               data-big="{{$img->getBackground()}}"></i>--}}
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
                                <a data-id="{{$product->id}}" class="active" href="{{$product->getUrl()}}"></a>
                                {{--                                @foreach($product->getChild() as $img)--}}
                                {{--                                    <a data-id="{{$img->id}}" href="{{$img->getUrl()}}"></a>--}}
                                {{--                                @endforeach--}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    @php
        $promotions = \App\Product::getPromotions(8);
        $present = \App\Product::getPresent(8);
    @endphp
    @if($promotions)
        <div class="Card CardTabs">
            <div class="container">
                <div class="container sixteen columns">
                    <h3 class="title-text">Акции:
                        <label class="tab active">Все</label>
                        <label class="tab">Скидки</label>
                        <label class="tab">+ подарок</label>
                    </h3>
                    <div id="form-1" class="tab-form active">
                        <div class="CardWr">
                            @foreach($promotions as $product)
                                <div class="CardBox">
                                    <div class="CardDiscount">
                                        <span class="item-hits">хит</span>
                                        <span class="item-new">new</span>
                                        @if($product->discount)
                                            <span class="item-disc">-{{$product->discount}}%</span>
                                        @endif
                                        @if($product->present)
                                            <span class="item-gift"></span>
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
                                            @if(in_array($product->type_of_product,['massage_chairs']))
                                                <i class="exemple-image color-{{$product->color}} CardBoxColorActive"
                                                   data-id="{{$product->id}}"
                                                   data-big="{{$product->getBackground()}}"></i>
                                            @endif
                                            {{--                                            @foreach($product->getChild() as $img)--}}
                                            {{--                                                <i class="exemple-image color-{{$img->color}}" data-id="{{$img->id}}"--}}
                                            {{--                                                   data-big="{{$img->getBackground()}}"></i>--}}
                                            {{--                                            @endforeach--}}
                                        </div>
                                        <p>{{$product->getType()}}</p>
                                        <h5>{{$product->name}}</h5>
                                        <div class="CardBoxPrice">
                                            <span>{{$product->price}} <b>тг</b></span>
                                            <button data-id="{{$product->id}}"
                                                    class="{{( in_array($product->id,$liked) ?'CardBoxPriceLiked':'CardBoxPriceLike')}}"></button>
                                        </div>
                                    </div>
                                    <a data-id="{{$product->id}}" class="active" href="{{$product->getUrl()}}"></a>
                                    {{--                                    @foreach($product->getChild() as $img)--}}
                                    {{--                                        <a data-id="{{$img->id}}" href="{{$img->getUrl()}}"></a>--}}
                                    {{--                                    @endforeach--}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="form-2" class="tab-form active">
                        <div class="CardWr">
                            @foreach($promotions as $product)
                                <div class="CardBox">
                                    <div class="CardDiscount">
                                        <span class="item-hits">хит</span>
                                        <span class="item-new">new</span>
                                        <span class="item-disc">-20%</span>
                                        @if($product->present)
                                            <span class="item-gift"></span>
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
                                            @if(in_array($product->type_of_product,['massage_chairs']))
                                                <i class="exemple-image color-{{$product->color}} CardBoxColorActive"
                                                   data-id="{{$product->id}}"
                                                   data-big="{{$product->getBackground()}}"></i>
                                            @endif
                                            {{--                                            @foreach($product->getChild() as $img)--}}
                                            {{--                                                <i class="exemple-image color-{{$img->color}}" data-id="{{$img->id}}"--}}
                                            {{--                                                   data-big="{{$img->getBackground()}}"></i>--}}
                                            {{--                                            @endforeach--}}
                                        </div>
                                        <p>{{$product->getType()}}</p>
                                        <h5>{{$product->name}}</h5>
                                        <div class="CardBoxPrice">
                                            <span>{{$product->price}} <b>тг</b></span>
                                            <button data-id="{{$product->id}}"
                                                    class="{{( in_array($product->id,$liked) ?'CardBoxPriceLiked':'CardBoxPriceLike')}}"></button>
                                        </div>
                                    </div>
                                    <a data-id="{{$product->id}}" class="active" href="{{$product->getUrl()}}"></a>
                                    {{--                                    @foreach($product->getChild() as $img)--}}
                                    {{--                                        <a data-id="{{$img->id}}" href="{{$img->getUrl()}}"></a>--}}
                                    {{--                                    @endforeach--}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="form-3" class="tab-form active">
                        <div class="CardWr">
                            @foreach($present as $product)
                                <div class="CardBox">
                                    <div class="CardDiscount">
                                        <span class="item-hits">хит</span>
                                        <span class="item-new">new</span>
                                        <span class="item-disc">-20%</span>
                                        @if($product->present)
                                            <span class="item-gift"></span>
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
                                            @if(in_array($product->type_of_product,['massage_chairs']))
                                                <i class="exemple-image color-{{$product->color}} CardBoxColorActive"
                                                   data-id="{{$product->id}}"
                                                   data-big="{{$product->getBackground()}}"></i>
                                            @endif
                                            {{--                                            @foreach($product->getChild() as $img)--}}
                                            {{--                                                <i class="exemple-image color-{{$img->color}}" data-id="{{$img->id}}"--}}
                                            {{--                                                   data-big="{{$img->getBackground()}}"></i>--}}
                                            {{--                                            @endforeach--}}
                                        </div>
                                        <p>{{$product->getType()}}</p>
                                        <h5>{{$product->name}}</h5>
                                        <div class="CardBoxPrice">
                                            <span>{{$product->price}} <b>тг</b></span>
                                            <button data-id="{{$product->id}}"
                                                    class="{{( in_array($product->id,$liked) ?'CardBoxPriceLiked':'CardBoxPriceLike')}}"></button>
                                        </div>
                                    </div>
                                    <a data-id="{{$product->id}}" class="active" href="{{$product->getUrl()}}"></a>
                                    {{--                                    @foreach($product->getChild() as $img)--}}
                                    {{--                                        <a data-id="{{$img->id}}" href="{{$img->getUrl()}}"></a>--}}
                                    {{--                                    @endforeach--}}
                                </div>
                            @endforeach
                        </div>
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
