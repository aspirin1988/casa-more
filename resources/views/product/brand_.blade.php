@extends('layouts.app')

@section('title')
    {{$brand->name}} || Casa & More
@endsection

@section('content')
    <section class="slider uk-position-relative uk-padding uk-visible@m">
        @include('widgets.brands_')
    </section>
    <section class="tabs">
        <div class="uk-container">
            <h1 style="display: none">{{$brand->name}}</h1>
            <brand-product-list-component :brand="'{{$brand->keyword}}'"></brand-product-list-component>
        </div>
    </section>
@endsection
