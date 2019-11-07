<div class="lg-grid-product-item">
    <ul class="uk-switcher switcher-container_{{$product->id}}">
        <li>
            <ul class="lg-tags">
                @foreach ($product->getTags() as $tag)
                    <li>
                        <a class="lg-icon-{{$tag->data->keyword}}"
                           href="/{{$tag->data->keyword}}/"></a>
                    </li>
                @endforeach
            </ul>
        </li>
        @foreach($product->child as $product_)
            <li>
                <ul class="lg-tags">
                    @foreach ($product_->getTags() as $tag)
                        <li>
                            <a class="lg-icon-{{$tag->data->keyword}}"
                               href="/{{$tag->data->keyword}}/"></a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
    <ul class="uk-switcher switcher-container_{{$product->id}}">
        <li>
            <a href="{{$product->getUrl()}}">
                <div class="lg-background-cover"
                     style="background-image: url('{{$product->getImage('thumb_bottle')}}')">
                    <canvas style="width: 260px; height: 260px "></canvas>
                </div>
            </a>
        </li>
        @foreach($product->child as $product_)
            <li>
                <a href="{{$product_->getUrl()}}?v={{$product_->volume}}">
                    <div class="lg-background-cover"
                         style="background-image: url('{{($product_->getImage('thumb_bottle')?$product_->getImage('thumb_bottle'):$product->getImage('thumb_bottle'))}}')">
                        <canvas style="width: 260px; height: 260px "></canvas>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
    <a href="{{$product->getUrl()}}" class="uk-link-reset uk-text-center">
        <h3 class="uk-card-title">{{$product->name}}</h3>
        <ul class="uk-switcher switcher-container_{{$product->id}}">
            <li>
                @if($product->discount)
                    <span class="price-discount">{{$product->price - (($product->price/100)*$product->discount) }} тг</span>
                    <span class="price-old">{{$product->price}} тг</span>
                @else
                    <span class="price">{{$product->price}} тг</span>
                @endif
            </li>
            @foreach($product->child as $product_)
                <li>
                    @if($product_->discount)
                        <span class="price-discount">{{$product_->price - (($product_->price/100)*$product_->discount) }} тг</span>
                        <span class="price-old">{{$product_->price}} тг</span>
                    @else
                        <span class="price">{{$product_->price}} тг</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </a>
    <ul class="volume-list" uk-switcher="connect: .switcher-container_{{$product->id}}">
        <li class="uk-active">
            <a href="#">{{$product->volume}} ml</a>
        </li>
        @foreach($product->child as $product_)
            <li>
                <a href=#>{{$product_->volume}} ml</a>
            </li>
        @endforeach

    </ul>
</div>
