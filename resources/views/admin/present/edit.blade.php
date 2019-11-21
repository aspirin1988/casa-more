@extends('admin.layouts.app')

@section('title')
    Admin - Present-Edit
@endsection

@section('content')
    <present_edit-component :id="{{$id}}"></present_edit-component>
@endsection
