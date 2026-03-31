@extends('layouts.app')

@section('title', 'Кейсы | Татьяна Щипицина')
@section('description', 'Реальные кейсы роста конверсии и эффективности отдела продаж.')

@section('content')
    <section class="section page-top">
        <div class="container section-head" data-reveal>
            <p class="eyebrow">Кейсы</p>
            <h1>Практические результаты в продажах и клиентском сервисе</h1>
            <p>Каждый проект начинается с аудита и заканчивается измеримым результатом.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <article class="featured-case" data-reveal>
                <p class="eyebrow">Флагманский кейс</p>
                <h2>{{ $featuredCase['title'] }}</h2>
                <p><strong>Запрос:</strong> {{ $featuredCase['clientPain'] }}</p>
                <p><strong>Решение:</strong> {{ $featuredCase['solution'] }}</p>
                <p class="featured-case__result"><strong>Результат:</strong> {{ $featuredCase['result'] }}</p>
            </article>
        </div>
    </section>

    <section class="section section--tight">
        <div class="container timeline">
            @foreach($timeline as $step)
                <article class="timeline-card" data-reveal>
                    <h3>{{ $step['month'] }}</h3>
                    <ul class="list">
                        @foreach($step['points'] as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head" data-reveal>
                <p class="eyebrow">Другие проекты</p>
                <h2>Коротко о результатах по другим клиентам</h2>
            </div>
            <div class="clients-grid">
                @foreach($shortCases as $case)
                    <article class="client-card" data-reveal>
                        @if(!empty($case['logo']))
                            <div class="client-card__logo-wrap">
                                <img class="client-card__logo" src="{{ asset($case['logo']) }}" alt="{{ $case['name'] }}">
                            </div>
                        @endif
                        <h3>{{ $case['name'] }}</h3>
                        <p>{{ $case['result'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container advice-grid">
            @foreach($recommendations as $block)
                <article class="card" data-reveal>
                    <h3>{{ $block['title'] }}</h3>
                    <ul class="list">
                        @foreach($block['items'] as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                </article>
            @endforeach
        </div>
    </section>
@endsection
