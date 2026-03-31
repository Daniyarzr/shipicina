<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Татьяна Щипицына | Продажи по телефону')</title>
    <meta name="description" content="@yield('description', 'Обучение отдела продаж, аудит звонков, сопровождение и рост конверсии.')">
    <link rel="icon" type="image/svg+xml" href="{{ asset($content['media']['favicon'] ?? 'favicon.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <script src="{{ asset('js/site.js') }}" defer></script>
</head>
<body>
    <div class="bg-orb bg-orb--one"></div>
    <div class="bg-orb bg-orb--two"></div>

    <header class="header">
        <div class="container header__inner">
            <a class="logo" href="{{ route('home') }}">
                <span class="logo__mark">TS</span>
                <span class="logo__text">Татьяна Щипицына</span>
            </a>

            <button class="menu-toggle" type="button" aria-label="Открыть меню">Меню</button>

            <nav class="nav">
                <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Главная</a>
                <a href="{{ route('services') }}" @class(['active' => request()->routeIs('services')])>Услуги</a>
                <a href="{{ route('cases') }}" @class(['active' => request()->routeIs('cases')])>Кейсы</a>
                <a href="{{ route('results') }}" @class(['active' => request()->routeIs('results')])>Результаты</a>
                <a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>Обо мне</a>
                <a href="{{ route('contacts') }}" @class(['active' => request()->routeIs('contacts')])>Контакты</a>
            </nav>

            <a class="btn btn--small" href="{{ route('contacts') }}#audit-form">Бесплатный аудит</a>
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container footer__inner">
            <div>
                <p class="footer__title">Татьяна Щипицина</p>
                <p class="footer__text">Обучение продажам и развитие клиентского сервиса</p>
            </div>
            <div class="footer__contacts">
                <a href="tel:+79120166581">+7 912 016-65-81</a>
                <a href="mailto:Tsm1981@bk.ru">Tsm1981@bk.ru</a>
            </div>
        </div>
    </footer>
</body>
</html>
