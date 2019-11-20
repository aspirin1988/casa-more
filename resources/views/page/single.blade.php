@extends('layouts.app')

@section('title')
    {{ $page->title  ?? 'Личный кабинет' }} || Casa & More
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="/css/form-in.css" type="text/css"/>
    <link rel="stylesheet" href="/css/page.css" type="text/css"/>
@stop

@section('script')
    @parent
    {{--    <script>--}}

    {{--        $(document).ready(function () {--}}
    {{--            $(".FormIn").on("click", ".tab", function () {--}}
    {{--                event.preventDefault();--}}
    {{--                $(".FormIn").find(".active").removeClass("active");--}}

    {{--                $(this).addClass("active");--}}

    {{--                $(".tab-form").eq($(this).index()).addClass("active");--}}
    {{--                return false;--}}
    {{--            });--}}
    {{--        });--}}

    {{--    </script>--}}
@stop

@section('content')
    <div class="FormIn">
        <div class="container">
            <div>
                <h1>{!! $page->title !!}</h1>
                <div>
                    @if($page->getThumb())
                        <img src="{{$page->getThumb()}}" alt="">
                    @endif
                    {!! $page->text!!}
                </div>
            </div>
        </div>
    </div>
@endsection
