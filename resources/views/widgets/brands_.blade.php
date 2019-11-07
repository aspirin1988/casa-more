    @php $brands = \App\Brand::getByAlphabet(); @endphp
    <div class="uk-position-top-center uk-card uk-card-default uk-position-z-index uk-margin-top uk-visible@s uk-navbar-brands"
         uk-navbar>
        <ul class="uk-navbar-nav uk-navbar-nav-colapsed">
            <li><a href="/all-brands">Все бренды</a></li>
            @foreach($brands as $key=>$items)
                <li class="@if(!count($items)) uk-disabled @endif" ><a href="#">{{strtoupper($key)}}</a>
                    @if(count($items))
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                @foreach($items as $item)
                                    <li><a href="/{{$item->keyword}}/">{{$item->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
