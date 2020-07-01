<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title',__('app.name'))</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="{{mix('/css/fonts.css')}}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    @include ('admin.styles.style')

</head>
<body class="uk-background-muted">
<header uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
    <nav class="uk-background-secondary uk-light" uk-navbar>
        <div class="uk-navbar-left">
            <img id="logo-mini" class="uk-hidden@m" src="/img/CasaMore_Logo.png" alt="">
            <img id="logo-big" class="uk-visible@m" style="width: 80px" src="/img/CasaMore_Logo.png" alt="">
            <ul class="uk-navbar-nav  uk-visible@m">
                <li>
                    <a href="#" id="trigger_menu"  onclick="window.show_trigger(this)">
                        <span class="uk-icon uk-button-default" uk-icon="more-vertical" style="padding: 5px"></span>
                    </a>
                </li>
            </ul>
            <a uk-navbar-toggle-icon="" href="#offcanvas" uk-toggle=""
               class="uk-navbar-toggle uk-hidden@m uk-navbar-toggle-icon uk-icon"></a>
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li>
                    <a href="#" class="" aria-expanded="false">{{ Auth::user()->getFullName() }}</a>
                    <div class="uk-navbar-dropdown uk-navbar-dropdown-bottom-right">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li class="uk-active">
                                <img src="{{\Illuminate\Support\Facades\Auth::user()->photo}}" alt="">
                            </li>
                            <li class="uk-nav-header">{{Auth::user()->job}}</li>
                            {{--<li><a href="{{route('admin_user_profile')}}">{{__('app.Settings')}}</a></li>--}}
                            <li class="uk-nav-divider"></li>
                            <li><a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); localStorage.clear(); document.getElementById('logout-form').submit();">{{__('app.Logout')}}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
@include('admin.layouts.aside')
<div id="app" class="uk-container uk-container-expand uk-container-custom">
    @yield('content')
</div>
@include ('admin.scripts.script')


</body>
</html>
