@extends('admin.layouts.app')

@section('title')
    Admin - Brand-Edit
@endsection

@section('content')
    <brand_edit-component :id="{{$id}}"></brand_edit-component>
@endsection
