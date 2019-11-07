<ul class="uk-switcher uk-margin switcher_{{$product->id}}">
    @if($count > 1)
        @if($product->getImage('thumb_flower'))
            <li>
                <div>
                    <img id="flower" src="{{$product->getImage('thumb_flower')}}"
                         alt="flower">
                    <div class="uk-product-parallax-before uk-visible@s"
                         style="background: url('{{$product->getImage('thumb_parallax_before')}}') no-repeat center center/contain ;"></div>
                    <div class="uk-product-parallax-after uk-visible@s"
                         style="background: url('{{$product->getImage('thumb_parallax_after')}}') no-repeat center center/contain ;"></div>
                </div>
            </li>
        @endif
        @if($product->getImage('thumb_bottle'))
            <li><img id="bottle" src="{{$product->getImage('thumb_bottle')}}"
                     alt="bottle"></li>
        @endif
        @if($product->getImage('thumb_box'))
            <li><img id="box" src="{{$product->getImage('thumb_box')}}" alt="box"></li>
        @endif
    @else
        <li><img id="bottle" src="{{$product->getImage('thumb_bottle')}}" alt="bottle">
        </li>
    @endif
</ul>
