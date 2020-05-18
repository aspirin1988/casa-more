@extends('layouts.app')

@section('title')
    Single || Casa & More
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="/css/main-style.css?v=3" type="text/css"/>
    <link rel="stylesheet" href="/css/comparison.css?v=3" type="text/css"/>
@stop

@section('script')
    @parent
@stop

@section('content')

    <product-comparison-component></product-comparison-component>


@endsection
