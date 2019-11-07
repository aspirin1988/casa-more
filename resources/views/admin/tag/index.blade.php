@extends('admin.layouts.app')

@section('title')
    Admin - Tag-List
@endsection

@section('content')
    <tag_list-component :current_page="{{$page}}"></tag_list-component>
@endsection
