@extends('admin.layouts.app')

@section('title')
    Admin - User-Edit
@endsection

@section('content')
    <user_edit-component :id="'{{$id}}'"></user_edit-component>
@endsection
