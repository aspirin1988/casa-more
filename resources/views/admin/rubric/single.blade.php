@extends('admin.layouts.app')

@section('title')
    Admin - Rubric-Single
@endsection

@section('content')
    <rubric_single-component :id="{{$id}}"></rubric_single-component>
@endsection
