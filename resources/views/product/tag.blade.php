@extends('layouts.app')

@section('content')
    <section class="slider uk-position-relative uk-padding">
        @include('widgets.brands_')
    </section>
    <section class="tabs uk-margin-medium">
        <div class="uk-container">
            <div uk-grid>
                <div class="uk-width-3-5@s">
                    <ul class="uk-breadcrumb">
                        <li class="uk-disabled"><h1><span
                                        class="uk-text-large uk-text-uppercase">{{$tag->name}}</span></h1></li>
                        <li><a href="/">Главная</a></li>
                    </ul>
                </div>
                <div class="uk-width-2-5@s">
                    <ul class="uk-filter">
                        <li><span class="uk-filter-heading">Сортировка:</span></li>
                        <li><a class="uk-button uk-button-small uk-text-bold uk-active" href="#">По названию</a></li>
                        <li><a class="uk-button uk-button-small uk-text-bold" href="#">по цене</a></li>
                    </ul>
                </div>
            </div>
            <div class="uk-card uk-card-default uk-filter-grid">
                <div class="uk-margin-right uk-position-relative">
                    <p class="uk-margin-remove uk-filter-grid-title">Цена:</p>
                    <i id="show_filter" class="uk-position-center-right uk-hidden@s" uk-icon="chevron-down"></i>
                </div>
                <div class="uk-filter-grid-price">
                    <label class="uk-form-label uk-min-price">
                        <input id="min-price" type="text" value="{{$min}}" multiple
                               class="uk-input uk-form-width-small">
                    </label>
                    <div class='multi-range'>
                        <hr/>
                        <!--<div id="progress" ></div>-->
                        <input id="form-h-range-1" class="uk-range" type='range' min='{{$min}}' max='{{$max-5}}'
                               step='5'
                               value='{{$min}}'>
                        <input id="form-h-range-2" class="uk-range" type='range' min='{{$min+5}}' max='{{$max}}'
                               step='5'
                               value='{{$max}}'>
                    </div>

                    <label class="uk-form-label uk-max-price">
                        <input id="max-price" type="text" value="{{$max}}" class="uk-input uk-form-width-small ">
                    </label>


                </div>
                <div class="uk-divider-container uk-visible@s">
                    <div class="uk-divider-vertical"></div>
                    <div class="uk-divider-vertical"></div>
                </div>
                <div class="uk-filter-grid-reset">
                    <button type="reset" class="uk-button uk-button-default uk-border-rounded">сбросить фильтры</button>
                </div>
            </div>

            <div class="lg-grid-product uk-tab-grid uk-custom-grid-collapse">
                @foreach($products as $product)
                    @include('product.list_item',['product'=>$product])
                @endforeach
            </div>
            @if(!count($products))

            @endif
        </div>

    </section>
@endsection
