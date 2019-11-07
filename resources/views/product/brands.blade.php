@extends('layouts.app')

@section('content')
    <section class="brands">
        <div class="uk-container">
            <h1 class="uk-h2 uk-text-uppercase uk-text-bold uk-text-center uk-margin-top uk-margin-bottom">Все бренды</h1>
        </div>
        @foreach($alphabet as $key=>$items)
        <div class="uk-brand-grid">
            <ul class="uk-container uk-custom-grid-1-6@s">
                <li><span>{{strtoupper($key)}}</span></li>
                @foreach($items as $item)
                    <li><a href="/{{$item->keyword}}/">{{$item->name}}</a></li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </section>
@endsection