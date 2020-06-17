@extends('admin.layouts.app')

@section('title')
    Admin - User-Edit
@endsection

@section('content')
    <user_edit-component :method="'{{$method}}'" :current_page="{{$page}}"></user_edit-component>
@endsection
