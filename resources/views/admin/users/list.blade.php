@extends('admin.layouts.app')

@section('title')
    Admin - User-List
@endsection

@section('content')
    <user_list-component :method="'{{$method}}'" :current_page="{{$page}}"></user_list-component>
@endsection
