<section class="slider uk-position-relative uk-margin-large-bottom">
    @include('widgets.brands_')
    <div uk-slideshow="animation: fade" class="uk-light uk-main-slider">
        <ul class="uk-dotnav uk-flex-center uk-margin uk-position-bottom-center uk-position-z-index uk-slideshow-nav uk-margin-large-bottom"></ul>
        @php $slider = \App\Slider::where('id',1)->first(); @endphp
        @php $items = $slider->getItemsWithPhoto(); @endphp
        <ul class="uk-slideshow-items">
            @foreach($items as $item)
                <li class="">
                    <a href="{{$item->link}}">
                        <div class="uk-background-cover uk-visible@s"
                             style="background-image: url('{{$item->data['desktop']->image}}')">
                            <canvas height="550px"></canvas>
                        </div>
                        {{--<img src="/img/Montale-RosesMusk_desk.jpg" class="uk-visible@s" uk-contain="" alt="">--}}
                        <img src="{{$item->data['mobile']->image}}" class="uk-hidden@s" alt="">
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="uk-position-center uk-visible@s" style="width: 66%;">
            <a class="uk-position-center-left uk-hidden-hover" href="#" uk-slidenav-previous
               uk-slideshow-item="previous"></a>
            <a class="uk-position-center-right uk-hidden-hover" href="#" uk-slidenav-next
               uk-slideshow-item="next"></a>
        </div>
    </div>
    <div class="uk-container uk-bottom-center-out">
        <nav class="uk-nav uk-navbar uk-card uk-card-default uk-padding-mini" uk-navbar="">
            <div class="uk-navbar-center">
                <ul class="uk-navbar-nav uk-navbar-nav-small-color uk-custom-grid-1-1 uk-custom-grid-1-4@s">
                    <li><a class="uk-padding-remove" href="/originalnost-produkczii"><i
                                    class="uk-icon-custom-medal"></i>Гарантия оригинальной продукции</a></li>
                    <li><a class="uk-padding-remove" href="/delivery/"><i class="uk-icon-custom-aircraft"></i>Бесплатная
                            доставка по казахстану</a></li>
                    <li><a class="uk-padding-remove" href="/oplata/"><i class="uk-icon-custom-card"></i>онлайн-оплата
                            банковской картой</a></li>
                    <li><a class="uk-padding-remove" href="/vozvrat-tovara"><i class="uk-icon-custom-back"></i>возврат
                            товара в течение 14 дней</a></li>
                </ul>
            </div>
        </nav>
    </div>
</section>
