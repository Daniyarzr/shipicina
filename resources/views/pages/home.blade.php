@extends('layouts.app')

@section('title', 'Татьяна Щипицина | Лучшие решения для вашего бизнеса')
@section('description', 'Повышение эффективности звонков, обучение менеджеров и рост конверсии в продажах.')

@section('content')
    <section class="hero">
        <div class="container hero__grid">
            <div data-reveal>
                <p class="eyebrow">Бизнес-тренер по продажам</p>
                <h1>{!! nl2br(e($content['hero']['title'])) !!}</h1>
                <p class="hero__lead">{{ $content['hero']['subtitle'] }}</p>
                <div class="hero__actions">
                    <a class="btn" href="{{ route('contacts') }}#audit-form">Записаться на аудит</a>
                    <a class="btn btn--ghost" href="{{ route('cases') }}">Смотреть кейсы</a>
                </div>
            </div>

            <figure class="hero__photo" data-reveal>
                <img src="{{ asset($content['media']['banner']) }}" alt="Татьяна Щипицина">
            </figure>
        </div>
    </section>

    <section class="section section--tight">
        <div class="container stats">
            @foreach($content['stats'] as $item)
                <article class="stat-card" data-reveal>
                    <p class="stat-card__value">{{ $item['value'] }}</p>
                    <p class="stat-card__label">{{ $item['label'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head" data-reveal>
                <p class="eyebrow">Кейсы</p>
                <h2>Как тренер по обучению персонала разрабатываю индивидуальные планы обучения</h2>
                <p>Учитываю специфику каждой компании и помогаю менеджерам закреплять результат в ежедневной работе.</p>
            </div>
            <div class="advice-grid">
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
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head" data-reveal>
                <p class="eyebrow">Наши клиенты</p>
                <h2>Результаты в цифрах</h2>
            </div>
            <div class="results-grid">
                @foreach($content['results'] as $item)
                    <article class="result-card" data-reveal>
                        <div class="result-card__logo-wrap">
                            <img class="result-card__logo" src="{{ asset($item['logo']) }}" alt="{{ $item['name'] }}">
                        </div>
                        <h3>{{ $item['name'] }}</h3>
                        <p>{{ $item['result'] }}</p>
                    </article>
                @endforeach
            </div>
            <div class="section-actions" data-reveal>
                <a class="btn btn--ghost" href="{{ route('results') }}">Открыть страницу результатов</a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head" data-reveal>
                <p class="eyebrow">Мои услуги</p>
                <h2>Все услуги можно модифицировать и комбинировать под ваш запрос</h2>
            </div>
            <div class="pricing-grid">
                @foreach($packages as $package)
                    <article class="price-card" data-reveal>
                        <div class="price-card__badge price-card__badge--{{ $package['color'] }}"></div>
                        <h3>{{ $package['name'] }}</h3>
                        <p class="price-card__hint">Цена за работу в течение 1 месяца</p>
                        <p class="price-card__value">{{ $package['price'] }}</p>
                        <ul class="list">
                            @foreach($package['items'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                        <a class="btn btn--full" href="{{ route('contacts') }}#audit-form">Заказать</a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container about-preview">
            <figure data-reveal>
                <img src="{{ asset($content['media']['about']) }}" alt="Татьяна Щипицина">
            </figure>
            <article data-reveal>
                <p class="eyebrow">Обо мне</p>
                <h2>{{ $content['about']['title'] }}</h2>
                @foreach($content['about']['paragraphs'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
                <a class="btn btn--ghost" href="{{ route('about') }}">Подробнее обо мне</a>
            </article>
        </div>
    </section>

    <section class="section section--cta">
        <div class="container cta-grid">
            <article data-reveal>
                <p class="eyebrow">Бесплатный аудит</p>
                <h2>Записаться на бесплатный аудит</h2>
                <p>Оставьте заявку в форме ниже, расскажите о своих пожеланиях, и я свяжусь с вами в течение 2 часов для назначения встречи.</p>
                <p class="cta-contact">Тел.: <a href="tel:+79120166581">+7 912 016-65-81</a></p>
                <p class="cta-contact">Email: <a href="mailto:Tsm1981@bk.ru">Tsm1981@bk.ru</a></p>
            </article>
            <div>
                @include('partials.audit-form')
            </div>
        </div>
    </section>
@endsection
