@extends('admin.layouts.app')

@section('title')
    Admin - Brand-List
@endsection

@section('content')
    <brand_list-component :current_page="{{$page}}"></brand_list-component>
@endsection
