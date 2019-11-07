@extends('admin.layouts.app')

@section('title')
    Admin - Slider-List
@endsection

@section('content')
    <slider_list-component :current_page="{{$page}}"></slider_list-component>
@endsection
