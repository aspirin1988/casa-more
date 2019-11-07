@extends('admin.layouts.app')

@section('title')
    Admin - Page-Single
@endsection

@section('content')
    <page_single-component :id="{{$id}}"></page_single-component>
@endsection
