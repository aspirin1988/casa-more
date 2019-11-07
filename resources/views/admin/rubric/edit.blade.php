@extends('admin.layouts.app')

@section('title')
    Admin - Rubric-Edit
@endsection

@section('content')
    <rubric_edit-component :id="{{$id}}"></rubric_edit-component>
@endsection
