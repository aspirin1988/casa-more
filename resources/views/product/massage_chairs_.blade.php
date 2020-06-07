<div class="CardWr">
    @foreach($products as $product)
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
                @if($product->present)
                    <i class="CardBoxImgGift" title="{{$product->present}}">
                        <img src="/img/Layer_2_copy.png" alt="{{$product->present}}">
                    </i>
                @endif
            </div>
            <div class="CardBoxDesc">
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
        @if(isset($products->perPage))
            {!! $products->render() !!}
        @endif
</div>
