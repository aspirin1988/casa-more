@extends('admin.layouts.app')

@section('title')
    Admin - Page-Edit
@endsection

@section('content')
    <page_edit-component :id="{{$id}}"></page_edit-component>
@endsection
