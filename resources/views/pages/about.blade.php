@extends('layouts.app')

@section('title', 'Обо мне | Татьяна Щипицина')
@section('description', 'О Татьяне Щипициной: опыт, подход к обучению и принципы работы с командами продаж.')

@section('content')
    <section class="section page-top">
        <div class="container about-preview">
            <figure data-reveal>
                <img src="{{ asset($content['media']['about']) }}" alt="Татьяна Щипицина">
            </figure>
            <article data-reveal>
                <p class="eyebrow">Обо мне</p>
                <h1>{{ $content['about']['title'] }}</h1>
                @foreach($content['about']['paragraphs'] as $line)
                    <p>{{ $line }}</p>
                @endforeach
            </article>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head" data-reveal>
                <h2>Профиль и опыт</h2>
            </div>
            <article class="card" data-reveal>
                <ul class="list">
                    @foreach($profileFacts as $fact)
                        <li>{{ $fact }}</li>
                    @endforeach
                </ul>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head" data-reveal>
                <h2>Как я работаю</h2>
            </div>
            <div class="principles-grid">
                @foreach($principles as $principle)
                    <article class="card" data-reveal>
                        <p>{{ $principle }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section--cta">
        <div class="container cta-inline" data-reveal>
            <h2>Готовы обсудить ваш отдел продаж?</h2>
            <a class="btn" href="{{ route('contacts') }}#audit-form">Оставить заявку</a>
        </div>
    </section>
@endsection
