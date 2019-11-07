@extends('layouts.app')

@section('title')
    {{$tag->name}} || Casa & More
@endsection

@section('content')
    <section class="slider uk-position-relative uk-padding">
        @include('widgets.brands_')
    </section>
    <section class="tabs uk-margin-medium">
        <div class="uk-container">
            <h1 style="display: none">{{$tag->name}}</h1>
            <tag-product-list-component :tag="'{{$tag->keyword}}'"></tag-product-list-component>
        </div>
    </section>
@endsection
