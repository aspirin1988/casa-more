@extends('admin.layouts.app')

@section('title')
    Admin - Media-List
@endsection

@section('content')
    <madia_list-component :current_page="{{$page}}"></madia_list-component>
@endsection
