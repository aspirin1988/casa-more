@extends('layouts.app')

@section('title')
    {{ $page->title  ?? 'Личный кабинет' }} || Casa & More
@endsection

@section('styles')
    @parent
    @php $v=  config('app.css_js_version', '?v=72')  ; @endphp
    <link rel="stylesheet" href="/css/form-in.css?v={{$v}}" type="text/css"/>
    <link rel="stylesheet" href="/css/page.css?v={{$v}}" type="text/css"/>
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
                <div class="">
                    @php $img = $page->getThumb() ; @endphp
                    @if($img && $img !='/img/empty.png' )
                        <div class="page-text">
                            <img style="width: 100%;" src="{{$img}}" alt="">
                        </div>
                    @endif
                    {!! $page->text!!}
                </div>
            </div>
        </div>
    </div>
@endsection
