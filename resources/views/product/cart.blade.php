@extends('layouts.app')

@section('title')
    Корзина || Casa & More
@endsection

@section('styles')
    @parent
    @php $v=  config('app.css_js_version', '?v=72')  ; @endphp
    <link rel="stylesheet" href="/css/form-in.css?v={{$v}}" type="text/css"/>
    <link rel="stylesheet" href="/css/cart.css?v={{$v}}" type="text/css"/>
@stop
@section('script')
    @parent
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $(".FormIn").on("click", ".tab", function() {--}}
{{--                // event.preventDefault();--}}
{{--                $(".FormIn").find(".active").removeClass("active");--}}

{{--                $(this).addClass("active");--}}

{{--                $(".tab-form").eq($(this).index()).addClass("active");--}}
{{--                return false;--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

{{--    <script type="text/javascript" >--}}
{{--        $(document).ready(function() {--}}
{{--            $('.minus').click(function () {--}}
{{--                var $input = $(this).parent().find('input');--}}
{{--                var count = parseInt($input.val()) - 1;--}}
{{--                count = count < 1 ? 1 : count;--}}
{{--                $input.val(count);--}}
{{--                $input.change();--}}
{{--                return false;--}}
{{--            });--}}
{{--            $('.plus').click(function () {--}}
{{--                var $input = $(this).parent().find('input');--}}
{{--                $input.val(parseInt($input.val()) + 1);--}}
{{--                $input.change();--}}
{{--                return false;--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@stop



@section('content')

    <div id="app">
        <cart-component></cart-component>
    </div>


@endsection
