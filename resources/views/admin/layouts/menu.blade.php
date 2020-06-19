@php

    @endphp
<ul class="uk-nav uk-nav-side  uk-nav-parent-icon" data-uk-nav="{multiple:true}">
    <li class="{{ in_array(Route::currentRouteName(),['admin']) ? 'uk-active' : '' }}">
        <a href="/admin/" title="Главная страница">
            <i class="uk-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <polygon points="18.65 11.35 10 2.71 1.35 11.35 0.65 10.65 10 1.29 19.35 10.65"></polygon>
                    <polygon points="15 4 18 4 18 7 17 7 17 5 15 5"></polygon>
                    <polygon
                        points="3 11 4 11 4 18 7 18 7 12 12 12 12 18 16 18 16 11 17 11 17 19 11 19 11 13 8 13 8 19 3 19"></polygon>
                </svg>
            </i>
            <span>Главная страница</span>
        </a>
    </li>
    <li>
        <a href="/admin/slider" title="Слайдеры">
            <i class="uk-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="album">
                    <rect x="5" y="2" width="10" height="1"></rect>
                    <rect x="3" y="4" width="14" height="1"></rect>
                    <rect fill="none" stroke="#000" x="1.5" y="6.5" width="17" height="11"></rect>
                </svg>
            </i>
            <span>Слайдеры</span>
        </a>
    </li>
    <li>
        <a href="/admin/media" title="Медиа">
            <i class="uk-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="image">
                    <circle cx="16.1" cy="6.1" r="1.1"></circle>
                    <rect fill="none" stroke="#000" x=".5" y="2.5" width="19" height="15"></rect>
                    <polyline fill="none" stroke="#000" stroke-width="1.01" points="4,13 8,9 13,14"></polyline>
                    <polyline fill="none" stroke="#000" stroke-width="1.01" points="11,12 12.5,10.5 16,14"></polyline>
                </svg>
            </i>
            <span>Медиа</span>
        </a>
    </li>
    <li class="">
        <a href="/admin/rubric" title="Рубрики">
            <i uk-icon="folder" class="uk-icon"></i>
            <span>Рубрики</span>
        </a>
    </li>
    <li>
        <a href="/admin/brand" title="Брэнды">
            <i class="uk-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="tag">
                    <path fill="none" stroke="#000" stroke-width="1.1"
                          d="M17.5,3.71 L17.5,7.72 C17.5,7.96 17.4,8.2 17.21,8.39 L8.39,17.2 C7.99,17.6 7.33,17.6 6.93,17.2 L2.8,13.07 C2.4,12.67 2.4,12.01 2.8,11.61 L11.61,2.8 C11.81,2.6 12.08,2.5 12.34,2.5 L16.19,2.5 C16.52,2.5 16.86,2.63 17.11,2.88 C17.35,3.11 17.48,3.4 17.5,3.71 L17.5,3.71 Z"></path>
                    <circle cx="14" cy="6" r="1"></circle>
                </svg>
            </i>
            <span>Брэнды</span>
        </a>
    </li>
    <li>
        <a href="/admin/product/massage_chairs" title="Товары">
            <i class="uk-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="cart">
                    <circle cx="7.3" cy="17.3" r="1.4"></circle>
                    <circle cx="13.3" cy="17.3" r="1.4"></circle>
                    <polyline fill="none" stroke="#000" points="0 2 3.2 4 5.3 12.5 16 12.5 18 6.5 8 6.5"></polyline>
                </svg>
            </i>
            <span>Товары</span>
        </a>
    </li>
    <li>
        <a href="/admin/present/" title="Подарки">
            <i class="uk-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="cart">
                    <circle cx="7.3" cy="17.3" r="1.4"></circle>
                    <circle cx="13.3" cy="17.3" r="1.4"></circle>
                    <polyline fill="none" stroke="#000" points="0 2 3.2 4 5.3 12.5 16 12.5 18 6.5 8 6.5"></polyline>
                </svg>
            </i>
            <span>Подарки</span>
        </a>
    </li>
    <li>
        <a href="/admin/tag" title="Тэги">
            <i class="uk-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="bookmark">
                    <polygon fill="none" stroke="#000" points="5.5 1.5 15.5 1.5 15.5 17.5 10.5 12.5 5.5 17.5"></polygon>
                </svg>
            </i>
            <span>Тэги</span>
        </a>
    </li>
    {{--    <li>--}}
    {{--        <a href="/admin/discount" title="Акции">--}}
    {{--            <i class="uk-icon uk-icon-image"--}}
    {{--               style=" width:20px; height:20px;background-image: url(/img/kisspng-computer-icons-encapsulated-postscript-discount-icon-5b2167417818f3.5661196815289157774919.png);"></i>--}}
    {{--            <span>Акции</span>--}}
    {{--        </a>--}}
    {{--    </li>--}}
    <li>
        <a href="/admin/page" title="Акции">
            <i class="uk-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="file-text">
                    <rect fill="none" stroke="#000" width="13" height="17" x="3.5" y="1.5"></rect>
                    <line fill="none" stroke="#000" x1="6" x2="12" y1="12.5" y2="12.5"></line>
                    <line fill="none" stroke="#000" x1="6" x2="14" y1="8.5" y2="8.5"></line>
                    <line fill="none" stroke="#000" x1="6" x2="14" y1="6.5" y2="6.5"></line>
                    <line fill="none" stroke="#000" x1="6" x2="14" y1="10.5" y2="10.5"></line>
                </svg>
            </i>
            <span>Страницы</span>
        </a>
    </li>
    <li>
        <a href="/admin/orders" title="Заказы">
            <i class="uk-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="cart">
                    <circle cx="7.3" cy="17.3" r="1.4"></circle>
                    <circle cx="13.3" cy="17.3" r="1.4"></circle>
                    <polyline fill="none" stroke="#000" points="0 2 3.2 4 5.3 12.5 16 12.5 18 6.5 8 6.5"></polyline>
                </svg>
            </i>
            <span>Заказы</span>
        </a>
        <a href="/admin/user/all" title="Пользователи">
            <i class="uk-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="users">
                    <circle fill="none" stroke="#000" stroke-width="1.1" cx="7.7" cy="8.6" r="3.5"></circle>
                    <path fill="none" stroke="#000" stroke-width="1.1"
                          d="M1,18.1 C1.7,14.6 4.4,12.1 7.6,12.1 C10.9,12.1 13.7,14.8 14.3,18.3"></path>
                    <path fill="none" stroke="#000" stroke-width="1.1"
                          d="M11.4,4 C12.8,2.4 15.4,2.8 16.3,4.7 C17.2,6.6 15.7,8.9 13.6,8.9 C16.5,8.9 18.8,11.3 19.2,14.1"></path>
                </svg>
            </i>
            <span>Пользователи</span>
        </a>
    </li>

</ul>
