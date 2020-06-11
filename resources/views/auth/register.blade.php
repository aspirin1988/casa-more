@extends('layouts.app')

@section('title')
    Регистрация || Casa & More
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="/css/form-in.css" type="text/css"/>
    <script>
        window.addEventListener('load', function () {
            let phone = document.querySelector('#phone');
            if (phone) {
                phone.addEventListener('keydown', function (e) {

                    console.log(e);

                    let phone_val = phone.value;
                    let mask = '1234567890';

                    if (mask.indexOf(e.key) < 0 && e.keyCode !== 8) {
                        event.preventDefault();
                        return false;
                    }
                    if (phone_val.length < 2) {
                        phone.value = '+7';
                    }
                    console.log(phone_val.length);
                    if (phone_val.length > 11) {
                        event.preventDefault();
                        return false;
                    }
                })
            }
        });
    </script>

@stop

@section('content')

    <div class="FormIn">
        <div class="container">
            <div class="FormInWr container sixteen columns">
                <h1>Личный кабинет</h1>
                <div class="FormInTop">
                    <a href="/login/" class="FormInTopBtn tab">Вход</a>
                    <a href="/register/" class="FormInTopBtn tab active">Регистрация</a>
                </div>
                <div id="form-1" class="tab-form">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <label>
                            <span>E-mail:</span>
                            <input type="email" name="" class="text">
                        </label>
                        <label>
                            <span>Пароль:</span>
                            <input type="password" name="" class="text">
                        </label>
                        <button class="FormBtn">войти</button>
                    </form>
                </div>
                <div id="form-2" class="tab-form active">
                    <form action="/register/" method="post">
                        @csrf
                        <label>
                            <span>Фамилия:</span>
                            <input id="first_name" type="text"
                                   class="text @error('first_name') is-invalid @enderror"
                                   name="first_name" value="{{ old('first_name') }}" required
                                   autocomplete="first_name" autofocus>
                        </label>
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                        <label>
                            <span>Имя:</span>
                            <input id="last_name" type="text"
                                   class="text @error('last_name') is-invalid @enderror"
                                   name="last_name" value="{{ old('last_name') }}" required
                                   autocomplete="last_name" autofocus>
                        </label>
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <label>
                            <span>E-mail:</span>
                            <input id="email" type="email"
                                   class="text @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email">
                        </label>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label>
                            <span>Телефон:</span>
                            <input id="phone" type="tel" name="phone" required="required"
                                   value="{{ old('phone') ?? '+7' }}"
                                   class="text">
                        </label>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label>
                            <span>Пароль:</span>
                            <input type="password" name="password" class="text">
                        </label>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <label>
                            <span>Пароль <br>еще раз:</span>
                            <input type="password" name="password_confirmation" class="text">
                        </label>
                        <button class="FormInBtn">Регистрация на сайте</button>
                        <label class="checkbox-form">
                            <input type="checkbox" required="required" name="">Соглашаюсь с условиями <a target="_blank"
                                                                                                         href="/img/оферта.pdf">
                                договора оферты</a>
                            <b></b>
                        </label>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
