@extends('layouts.app')

@section('title')
    Личный кабинет || Casa & More
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="/css/main-style.css?v=5" type="text/css"/>
    <link rel="stylesheet" href="/css/form-in-post.css?v=5" type="text/css"/>
    <style>
        .uk-container {
            position: fixed;
            top: 0;
            left: 100%;
            transform: translate(-100%, 10px);
            z-index: 10;
        }
    </style>
@stop

@section('script')
    @parent
    <script>

        $(document).ready(function () {
            $(".FormIn").on("click", ".tab", function () {
                event.preventDefault();
                $(".FormIn").find(".active").removeClass("active");

                $(this).addClass("active");

                $(".tab-form").eq($(this).index()).addClass("active");
                return false;
            });

            $("[data-repay-id]").click(function () {
                this.disabled = true;
                $.get('/repay/order/' + this.dataset.repayId, (data) => {
                    if (data.result) {
                        localStorage.setItem('basket', JSON.stringify([]));
                        localStorage.setItem('basket_summary', 0);
                        setTimeout(function () {
                            location.href = data.redirect_to;
                        }, 300);
                    }else{
                        console.error(data.errors);
                        for(let n in data.errors) {
                            data.errors[n].forEach(function (i) {
                                console.log(i);
                                UIkit.notification({message: i, status: 'danger'});
                            });
                        }

                    }
                });
            });

            $("[data-order-id]").click(function () {
                this.querySelector('svg').classList.add('rotate');
                this.disabled = true;
                $.get('/pay/success/' + this.dataset.orderId, (data) => {
                    console.log(data);
                    if(data.success){
                        let order = $('[data-order="' + this.dataset.orderId + '"]');
                        if(data.result.status == 4) {
                            order.html('Оплачен');
                            order.css('background', '#0d8c00');
                            this.style.display = 'none'
                        }else{
                            order.html('Не оплачен');
                            order.css('background', 'rgb(240, 80, 110)');
                        }
                    }
                    this.querySelector('svg').classList.remove('rotate');
                    this.disabled = false;
                })
            });
        });

    </script>
@stop

@section('content')
    <div class="FormIn">
        <div class="container">
            <div class="container sixteen columns">
                <div class="FormInWr">
                    <h1>Личный кабинет</h1>
                    <div class="FormInTop">
                        <a href="#" class="FormInTopBtn tab active">Данные</a>
                        <a href="#" class="FormInTopBtn tab">История покупок</a>
                        <a href="#" class="FormInTopBtn tab">Избранное</a>
                        <a href="#" class="FormInTopBtn tab">Смена пароля</a>
                        <a href="{{ route('logout') }}" class="FormInTopBtn exit"
                           onclick="event.preventDefault(); localStorage.clear(); document.getElementById('logout-form').submit();"></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>
                    <div id="form-1" class="tab-form active">
                        <form action="">
                            <label>
                                <span>Фамилия:</span>
                                <input type="text" name="first_name" value="{{$user->first_name}}" class="text">
                            </label>
                            <label>
                                <span>Имя:</span>
                                <input type="text" name="last_name" value="{{$user->last_name}}" class="text">
                            </label>
                            <label>
                                <span>E-mail:</span>
                                <input type="email" name="email" value="{{$user->email}}" disabled="disabled"
                                       class="text">
                            </label>
                            <label>
                                <span>Телефон:</span>
                                <input type="tel" name="phone" value="{{$user->phone}}" class="text">
                            </label>
                            <button class="FormBtn">Сохранить</button>
                        </form>
                    </div>
                    <div id="form-2" class="tab-form">
                        @foreach($orders as $item)
                            <div class="CartCardWr">
                                <h5>
                                    {{$item->created_at}}
                                    @if($item->status)
                                        <span style="margin-left: 10px;background: #0d8c00;color: #fff;padding: 5px 10px;" data-order="{{$item->id}}">Оплачен</span>
                                    @else
                                        <span style="margin-left: 10px;background: #f0506e;color: #fff;padding: 5px 10px;" data-order="{{$item->id}}" >Не оплачен</span>
                                        <button data-order-id="{{$item->id}}"
                                                style="background: #395669; color: #fff;border: none; cursor: pointer ">
                                            <svg width="30" height="30" viewBox="0 0 20 20" class=""
                                                 style="padding: 3px 5px;"
                                                 xmlns="http://www.w3.org/2000/svg" data-svg="future">
                                                <polyline fill="#fff" stroke="#fff"
                                                          points="19 2 18 2 18 6 14 6 14 7 19 7 19 2"></polyline>
                                                <path fill="none" stroke="#fff" stroke-width="1.1"
                                                      d="M18,6.548 C16.709,3.29 13.354,1 9.6,1 C4.6,1 0.6,5 0.6,10 C0.6,15 4.6,19 9.6,19 C14.6,19 18.6,15 18.6,10"></path>
                                            </svg>
                                        </button>
                                        <button data-repay-id="{{$item->id}}"
                                                style="background: #ee395b; color: #fff;border: none; cursor: pointer ">
                                            Запросить счет еще раз
                                        </button>
                                    @endif

                                </h5>
                                @php $sum =0; @endphp
                                @foreach($item->products as $val)
                                    <div class="CartCard">
                                        <div class="CartCardImg">
                                            <img src="/img/ind-cat-01.png">
                                        </div>
                                        <h3>{{$val->name}}</h3>
                                        <div class="CartCardCount">
                                            <input type="number" name="count" value="{{$val->count}}">
                                            <span class="plus">▲</span>
                                            <span class="minus">▼</span>
                                        </div>
                                        @if($val->discount)
                                            @php $sum += $val->price-(($val->price/100)*$val->discount); @endphp
                                            <span class="CartCardPrice">{{$val->price-(($val->price/100)*$val->discount)}} <small>тг</small></span>
                                        @else
                                            @php $sum += $val->price; @endphp
                                            <span class="CartCardPrice">{{$val->price}} <small>тг</small></span>
                                        @endif
                                        <div class="CartCardRemove">
                                            <button class="CartCardRemoveBtn" type="submit">×</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="CartCardPriceAll">
                                <span>Стоимость:</span>
                                <div class="CartCardPriceAllR">
                                    <b>{{number_format($sum,0,'.',' ')}} тг</b>
                                    <div class="ProdPostGift">
                                        <i class="item-gift">
                                            <img src="/img/Layer_2_copy.png">
                                        </i>
                                        <span>подарок</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="form-3" class="tab-form Card CardTpl">
                        <div class="CardWr">
                            @foreach($select_products as $select_product)
                                @php $product = $select_product->product @endphp
                                @if($product)
                                    <div class="CardBox">
                                        <div class="CardDiscount">
                                            <span class="item-hits">хит</span>
                                            @if($product->discount)
                                                <span class="item-disc">-{{$product->discount}}%</span>
                                            @endif
                                        </div>
                                        <div class="CardBoxImg">
                                            <img id="green_monster" src="{{$product->getBackground()}}"
                                                 data-big="{{$product->getBackground()}}">
                                            {{--                                            <i class="CardBoxImgGift">--}}
                                            {{--                                                <img src="/img/Layer_2_copy.png">--}}
                                            {{--                                            </i>--}}
                                        </div>
                                        <div class="CardBoxDesc">
                                            {{--                                            <div class="CardBoxColor">--}}
                                            {{--                                                @foreach($product->getChild() as $img)--}}
                                            {{--                                                    <i class="exemple-image" data-big="{{$img->getBackground()}}"></i>--}}
                                            {{--                                                @endforeach--}}
                                            {{--                                            </div>--}}
                                            <p>{{$product->getType()}}</p>
                                            <h5>{{$product->name}}</h5>
                                            <div class="CardBoxPrice">
                                                <span>{{$product->price}} <b>тг</b></span>
                                                <button class="CardBoxPriceLike"></button>
                                            </div>
                                        </div>
                                        <a href="{{$product->getUrl()}}"></a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="form-4" class="tab-form">
                        <form-reset-component></form-reset-component>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
