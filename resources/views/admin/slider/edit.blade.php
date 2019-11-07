@extends('admin.layouts.app')

@section('title')
    Admin - Slider-Edit
@endsection

@section('content')
    <slider_edit-component :id="{{$id}}"></slider_edit-component>
@endsection
