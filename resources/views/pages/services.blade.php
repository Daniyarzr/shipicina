@extends('layouts.app')

@section('title', 'Услуги | Татьяна Щипицина')
@section('description', 'Пакеты сопровождения отдела продаж, аудит звонков и рекрутинг.')

@section('content')
    <section class="section page-top">
        <div class="container section-head" data-reveal>
            <p class="eyebrow">Мои услуги</p>
            <h1>Комплексная работа с отделом продаж и клиентской базой</h1>
            <p>Каждый формат можно адаптировать под вашу нишу, команду и бизнес-цели.</p>
        </div>
    </section>

    <section class="section">
        <div class="container pricing-grid">
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
                    <a class="btn btn--full" href="{{ route('contacts') }}#audit-form">Выбрать</a>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section">
        <div class="container direction-grid">
            @foreach($directions as $direction)
                <article class="card" data-reveal>
                    <h2>{{ $direction['title'] }}</h2>
                    <p>{{ $direction['subtitle'] }}</p>
                    <p class="card__title">Что входит:</p>
                    <ul class="list">
                        @foreach($direction['actions'] as $action)
                            <li>{{ $action }}</li>
                        @endforeach
                    </ul>
                    <p class="card__title">Примеры результатов:</p>
                    <ul class="list">
                        @foreach($direction['cases'] as $case)
                            <li>{{ $case }}</li>
                        @endforeach
                    </ul>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section section--cta">
        <div class="container cta-inline" data-reveal>
            <h2>Нужна точная конфигурация под ваш бизнес?</h2>
            <a class="btn" href="{{ route('contacts') }}#audit-form">Записаться на аудит</a>
        </div>
    </section>
@endsection
