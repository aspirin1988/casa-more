@extends('admin.layouts.app')

@section('title')
    Admin - Rubric-List
@endsection

@section('content')
    <rubric_list-component :current_page="{{$page}}"></rubric_list-component>
@endsection
