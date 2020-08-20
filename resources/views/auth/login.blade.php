@extends('layouts.app')

@section('title')
    Личный кабинет || Casa & More
@endsection

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
                <h1>Личный кабинет</h1>
                <div class="FormInTop">
                    <a href="/login/" class="FormInTopBtn tab active">Вход</a>
                    <a href="/register/" class="FormInTopBtn tab">Регистрация</a>
                </div>
                <div id="form-1" class="tab-form active">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <label>
                            <span>E-mail:</span>
                            <input type="email" name="email" value="{{ old('email') }}" class="text">
                        </label>
                        <label>
                            <span>Пароль:</span>
                            <input type="password" name="password" value="{{ old('password') }}" class="text">
                        </label>
                        <label>
                            <a href="/password/reset">
                            <span>Забыли пароль?</span>
                            </a>
                        </label>
                        <button class="FormBtn">войти</button>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </form>
                </div>
                <div id="form-2" class="tab-form">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <label>
                            <span>Имя:</span>
                            <input type="text" name="name" value="{{ old('name') }}" class="text">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </label>
                        <label>
                            <span>E-mail:</span>
                            <input type="email" name="email" value="{{ old('email') }}" class="text">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </label>
                        <label>
                            <span>Телефон:</span>
                            <input type="tel" name="phone" value="{{ old('email') }}" class="text">
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('phone') }}</strong></span>
                            @endif
                        </label>
                        <label>
                            <span>Пароль:</span>
                            <input type="password" name="password" class="text">
                        </label>
                        <label>
                            <span>Пароль <br>еще раз:</span>
                            <input type="password" name="password_confirmation" class="text">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </label>
                        <button class="FormInBtn">Регистрация на сайте</button>
                        <label class="checkbox-form">
                            <input type="checkbox" name="">Соглашаюсь с условиями <a target="_blank" href="/img/оферта.pdf"> договора оферты</a>
                            <b></b>
                        </label>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
