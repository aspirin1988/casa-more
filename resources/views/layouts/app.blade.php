<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Главная || Casa & More')</title>
    <meta property="og:title" content="">
    <meta name="it-rating" content="it-rat-24ca1971faadab1e67e8692cad77ab81"/>
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="x-rim-auto-match" content="none">
    @section('styles')
        <link rel="stylesheet" href="/css/main-style.css" type="text/css"/>
        <link rel="stylesheet" href="/js/owl.carousel.min.css">
        <link
            href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap&subset=cyrillic"
            rel="stylesheet">
    @show
</head>
<body>
<div class="uk-container"></div>
<div id="app">
    <header
        class="Header {{(in_array(Route::currentRouteName(),['massage_chairs','massagers','fitness_equipment','household_products','other_rubric'])?'HeaderWhite':'')}}">
        <a href="/" class="HeaderLogo">
            <img src="/img/CasaMore_Logo.png">
        </a>
        <nav class="HeaderNav">
            <ul>
                <li>
                    <a href="#" class="dropdown-toogle">Каталог</a>
                    <ul>
                        @foreach( App\Rubric::where('show_index',1)->orderBy('order')->get() as $rubric )
                            <li><a href="{{$rubric->getUrl()}}">{{$rubric->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="#" class="dropdown-toogle">Акции и скидки</a>
                    <ul>
                        <li><a href="/sales">скидки</a></li>
                        <li><a href="/present">+ подарок</a></li>
                        <li><a href="/new">новинки</a></li>
                        <li><a href="/hit">хиты продаж</a></li>
                    </ul>
                </li>
                <li><a href="#" class="dropdown-toogle">Покупателям</a>
                    <ul>
                        <li><a target="_blank" href="/garant/">Гарантия</a></li>
                        <li><a href="/delivery/">доставка</a></li>
                        <li><a href="/oplata/">онлайн-оплата</a></li>
                        <li><a href="/drive/">тест-драйв</a></li>
                        <li><a href="/product-comparison">сравнение товаров</a></li>
                        <li><a href="/news">новости</a></li>
                        <li><a target="_blank" href="/img/оферта.pdf">договор оферты</a></li>
                    </ul>
                </li>
                <li><a href="/about">О нас</a></li>
                <li><a href="/contacts">Контакты</a></li>
                <li><a href="/product-comparison">Сравнение товаров</a></li>
            </ul>
        </nav>
        <div class="HeaderRight">
            <a href="/search" class="item-header-right search"></a>
            <a href="/login/" class="item-header-right user"></a>
            <basket_button-component></basket_button-component>
            <a class="BurgerMenu open-btn"><b></b></a>
        </div>
    </header>

    @yield('content')

    <footer>
        <div class="fTop">
            <div class="container">
                <div class="container sixteen columns">
                    <div class="fTopBODY">
                        <div class="fTopBODYBL">
                            <h4>Каталог товаров:</h4>
                            <ul>
                                @foreach( App\Rubric::where('show_index',1)->orderBy('order')->get() as $rubric )
                                    <li><a href="{{$rubric->getUrl()}}">{{$rubric->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="fTopBODYBL">
                            <h4>Акции и скидки:</h4>
                            <ul>
                                <li><a href="/sales">скидки</a></li>
                                <li><a href="/present">+ подарок</a></li>
                                <li><a href="/new">новинки</a></li>
                                <li><a href="/hit">хиты продаж</a></li>
                            </ul>
                        </div>

                        <div class="fTopBODYBL">
                            <h4>Покупателям:</h4>
                            <ul>
                                <li><a target="_blank" href="/img/sincerity_garant2.pdf">Гарантия</a></li>
                                <li><a href="/delivery/">доставка</a></li>
                                <li><a href="/oplata/">онлайн-оплата</a></li>
                                <li><a href="/drive/">тест-драйв</a></li>
                                <li><a href="/product-comparison">сравнение товаров</a></li>
                                <li><a href="/news">новости</a></li>
                                <li><a target="_blank" href="/img/оферта.pdf">договор оферты</a></li>
                            </ul>
                        </div>

                        <div class="fTopBODYBL">
                            <p><a href="/about">О нас</a></p>
                            <p><a href="/contacts">контакты</a></p>
                            <div class="fTopBODYBLSoc">
                                <a target="_blank" href="https://www.instagram.com/casaandmore/" class="ins"></a>
                                <a target="_blank" href="https://www.facebook.com/casamorekz/?modal=admin_todo_tour"
                                   class="fb"></a>
                                <a target="_blank" href="" class="yt"></a>
                            </div>
                            <p><a href="tel:+7(701)0063555">+7 (701) 006 35 55</a></p>
                            <p><a href="tel:+7(727)3006001">+7 (727) 300 60 01</a></p>
                            <p><a href="mailto:styalmaty@gmail.com">styalmaty@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fBot">
            <div class="container">
                <div class="fBotWr container sixteen columns">

                    <div class="fBotWebCopy"><p><b>casa&more</b>, 2019. Все права защищены</p></div>

                    <div class="fBotWebCopy"><p><a style="color: #aaaaaa;" href="https://pay.post.kz/ru/">Система оплаты
                                - <img src="/img/post_kz.png" alt="Система оплаты"></a></p>
                    </div>

                    <div class="fBotWeb">
                        <span>Разработка сайта - <a href="https://prostokosmos.kz/">просто космос!</a></span>
                    </div>

                </div>
            </div>
        </div>
    </footer>
</div>
<div class="">
    <div class="container">
        <div class="container sixteen columns">

        </div>
    </div>
</div>
@section('script')
    <script>

        window.UIkit = {};
        window.UIkit.container = document.querySelector('.uk-container');

        window.UIkit.notification = function (obj) {
            console.log(obj);
            if (obj) {
                let div = document.createElement('DIV');
                div.classList.add('uk-notification');
                div.classList.add('uk-notification-' + obj.status);
                div.innerHTML = obj.message;
                UIkit.container.append(div);
                setTimeout(function () {
                    div.remove();
                }, 10000);
            }
        };

        window.sendToSelect = function (e) {
            console.log(e.target);
            let send = {
                _token: document.head.querySelector('meta[name="csrf-token"]').content,
                id: this.dataset['id'],
            };
            $.post("/add/to-select", send, function (data) {
                if (data.result) {
                    UIkit.notification({message: data.message, status: 'success'});
                    e.target.classList.add('CardBoxPriceLiked');
                } else {
                    if (!data.auth) {
                        window.open('/login/', '_blank');
                    }
                }
            });
            return false;
        };
    </script>
    <script src="/js/app.js?v=22"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="/js/owl.carousel.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $('.CardBoxPriceLike').on('click', sendToSelect);

        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            items: 1,
            stagePadding: 0,
            smartSpeed: 1250,
            autoplay: true,
            autoplayHoverPause: true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            navText: 0
        })
    </script>
    <script>
        $(document).ready(function () {
            $(".CardTabs").on("click", ".tab", function () {

                $(".CardTabs").find(".active").removeClass("active");

                $(this).addClass("active");

                $(".tab-form").eq($(this).index()).addClass("active");
            });
            $.each($('.tab-form.active'), function (i, j) {
                if (i) {
                    j.classList.remove('active');
                }
            });
        });
    </script>
    <script>
        $('.CardBox .exemple-image').on('click', function () {

            let id = this.dataset['id'];

            $('.CardBox .exemple-image').removeClass('CardBoxColorActive');
            $(this).addClass('CardBoxColorActive');
            $(this).parents('.CardBox').find('#green_monster').attr('src', $(this).data('big'));

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
    <script>
        $(document).ready(function () {

            var modal = $('.popup-menu'),
                link = $('.open-btn');

            link.on('click', function () {
                $(this).toggleClass('close-btn');
                modal.toggleClass('popup-active');
                if (modal.hasClass('popup-active')) {
                    document.body.style.overflowY = 'hidden';
                } else {
                    document.body.style.overflowY = 'auto';
                }
            });

            $('.popup-menu-mob .dropdown-toogle').on('click', function () {
                $(this).toggleClass('dropdown-toogle-slide');
            });
        });
    </script>
@show

<div class="popup-menu">
    <ul class="popup-menu-mob">
        <li>
            <a href="#" class="dropdown-toogle">Каталог</a>
            <ul>
                @foreach( App\Rubric::where('show_index',1)->orderBy('order')->get() as $rubric )
                    <li><a href="{{$rubric->getUrl()}}">{{$rubric->name}}</a></li>
                @endforeach
            </ul>
        </li>
        <li><a href="#" class="dropdown-toogle">Акции и скидки</a>
            <ul>
                <li><a href="/massage_chairs/">Массажные кресла</a></li>
                <li><a href="/massagers/">Массажеры</a></li>
                <li><a href="/fitness_equipment/">фитнес оборудование</a></li>
                <li><a href="/household_products/">товары для дома</a></li>
            </ul>
        </li>
        <li><a href="#" class="dropdown-toogle">Покупателям</a>
            <ul>
                <li><a target="_blank" href="/img/sincerity_garant2.pdf">Гарантия</a></li>
                <li><a href="/delivery/">доставка</a></li>
                <li><a href="/oplata/">онлайн-оплата</a></li>
                <li><a href="/drive/">тест-драйв</a></li>
                <li><a href="/product-comparison">сравнение товаров</a></li>
                <li><a href="/news">новости</a></li>
                <li><a target="_blank" href="/img/оферта.pdf">договор оферты</a></li>
            </ul>
        </li>
        <li><a href="/about">О нас</a></li>
        <li><a href="/contacts">Контакты</a></li>
        <li><a href="/product-comparison">Сравнение товаров</a></li>
    </ul>
</div>
</body>

</html>
