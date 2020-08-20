@extends('layouts.app')

@section('title')
    Поиск || Casa & More
@endsection

@section('styles')
    @parent
    @php $v=  config('app.css_js_version', '?v=72')  ; @endphp
    <link rel="stylesheet" href="/css/main-style.css?v={{$v}}" type="text/css"/>
    <link rel="stylesheet" href="/css/product-post.css?v={{$v}}" type="text/css"/>
@stop

@section('script')
    @parent
@stop

@section('content')

    <widget-search-product-component></widget-search-product-component>

@endsection
