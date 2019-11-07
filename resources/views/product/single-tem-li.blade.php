<ul class="uk-custom-product-view-list"
    uk-switcher="connect:.switcher_{{$product->id}}">
    @if($count > 1)
        @if($product->getImage('thumb_flower'))
            <li class="uk-active"><i class="uk-custom-product-view-flower"></i></li>
        @endif
        @if($product->getImage('thumb_bottle'))
            <li><i class="uk-custom-product-view-bottle"></i></li>
        @endif
        @if($product->getImage('thumb_box'))
            <li><i class="uk-custom-product-view-box"></i></li>
        @endif
    @else
        <li class="uk-active uk-hidden"><i class="uk-custom-product-view-bottle"></i>
        </li>
    @endif
</ul>
