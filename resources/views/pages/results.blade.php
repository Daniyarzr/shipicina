@extends('layouts.app')

@section('title', 'Результаты в цифрах | Татьяна Щипицина')
@section('description', 'Клиенты и результаты: конверсия, оборот и рост продаж в цифрах.')

@section('content')
    <section class="section page-top">
        <div class="container section-head" data-reveal>
            <p class="eyebrow">Наши клиенты</p>
            <h1>Результаты в цифрах</h1>
            <p>Реальные примеры роста конверсии и оборота после внедрения системы обучения и сопровождения.</p>
        </div>
    </section>

    <section class="section">
        <div class="container results-grid results-grid--wide">
            @foreach($content['results'] as $item)
                <article class="result-card result-card--big" data-reveal>
                    <div class="result-card__logo-wrap">
                        <img class="result-card__logo" src="{{ asset($item['logo']) }}" alt="{{ $item['name'] }}">
                    </div>
                    <h2>{{ $item['name'] }}</h2>
                    <p>{{ $item['result'] }}</p>
                </article>
            @endforeach
        </div>
    </section>
@endsection
