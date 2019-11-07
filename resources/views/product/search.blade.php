@extends('layouts.app')

@section('title')
    Поиск || Casa & More
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="/css/main-style.css" type="text/css"/>
    <link rel="stylesheet" href="/css/product-post.css" type="text/css"/>
@stop

@section('script')
    @parent
@stop

@section('content')

    <widget-search-product-component></widget-search-product-component>

@endsection
