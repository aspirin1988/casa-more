<div class="CardWr">
    @foreach($products as $product)
        <div class="CardBox">
            <div class="CardDiscount">
                @foreach($product->getTags() as $tag)
                    @switch($tag->data->keyword )
                        @case('new')
                        <span class="item-new">new</span>
                        @break
                        @case('hit')
                        <span class="item-hits">хит</span>
                        @break
                    @endswitch
                @endforeach
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
                                    <span>{{$product->getPrice()}} <b>тг</b>
                                        @if($product->getOldPrice())
                                            <small>{{$product->getOldPrice()}}</small>
                                        @endif
                                    </span>
                    <button data-id="{{$product->id}}"
                            class="{{( in_array($product->id,$liked) ?'CardBoxPriceLiked':'CardBoxPriceLike')}}"></button>
                </div>
            </div>
            <a href="{{$product->getUrl()}}"></a>
        </div>
    @endforeach
    {{--        @if(isset($products->perPage))--}}
    {!! $products->links('widgets._paginate',['paginator'=>$products,'method'=>$method]) !!}
    {{--        @endif--}}
</div>
