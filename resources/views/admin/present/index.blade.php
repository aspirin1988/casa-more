@extends('admin.layouts.app')

@section('title')
    Admin - Present-List
@endsection

@section('content')
    <present_list-component :current_page="{{$page}}"></present_list-component>
@endsection
