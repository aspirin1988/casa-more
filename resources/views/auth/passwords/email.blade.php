@extends('layouts.app')

@section('styles')
    @parent
    @php $v=  config('app.css_js_version', '?v=72')  ; @endphp
    <link rel="stylesheet" href="/css/form-in.css?v={{$v}}" type="text/css"/>
    <style>
        .invalid-feedback{
            color: #f00;
        }
    </style>
@stop

@section('script')
    @parent
@stop

@section('content')
    <div class="FormIn">
        <div class="container">
            <div class="FormInWr container sixteen columns">
                <h1>{{ __('passwords.Reset Password') }}</h1>
                <div id="form-1" class="tab-form active">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <label>
                            <span>E-mail:</span>
                            <input type="email" name="email" value="{{ old('email') }}" class="text" required autocomplete="email" autofocus>
                        </label>

                        <button type="submit" class="FormBtn">{{ __('passwords.Send Password Reset Link') }}</button>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}

{{--                <div class="card-header">{{ __('passwords.Reset Password') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    <form method="POST" action="{{ route('password.email') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Send Password Reset Link') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}
