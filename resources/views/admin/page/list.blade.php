@extends('admin.layouts.app')

@section('title')
    Admin - Page-List
@endsection

@section('content')
    <page_list-component :current_page="{{$page}}"></page_list-component>
@endsection
