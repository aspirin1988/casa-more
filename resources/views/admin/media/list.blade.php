@extends('admin.layouts.app')

@section('title')
    Admin - Image-List
@endsection

@section('content')
    <image_list-component :dir="'{{$dir}}'"></image_list-component>
@endsection
