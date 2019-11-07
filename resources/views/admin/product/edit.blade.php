@extends('admin.layouts.app')

@section('title')
    Admin - Product-Edit
@endsection

@section('content')
    <product_edit-component :id="{{$id}}"></product_edit-component>
@endsection
