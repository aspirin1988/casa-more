@extends('admin.layouts.app')

@section('title')
    Admin - Order-List
@endsection

@section('content')
    <order_list-component :current_page="{{$page}}"></order_list-component>
@endsection
