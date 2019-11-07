@extends('admin.layouts.app')

@section('title')
    Admin - Product-List
@endsection

@section('content')
    <product_list-component :method="'{{$method}}'" :current_page="{{$page}}"></product_list-component>
@endsection
