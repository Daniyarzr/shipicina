<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход в админку</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body class="admin-page">
    <main class="admin-login">
        <section class="admin-login__card">
            <h1>Админ-панель</h1>
            <p>Вход для управления заявками и контентом сайта</p>

            @if ($errors->any())
                <div class="alert alert--error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="form" action="{{ route('admin.login.store') }}" method="post">
                @csrf
                <label class="field">
                    <span>Логин</span>
                    <input type="text" name="login" value="{{ old('login') }}" required>
                </label>
                <label class="field">
                    <span>Пароль</span>
                    <input type="password" name="password" required>
                </label>
                <button class="btn btn--full" type="submit">Войти</button>
            </form>
        </section>
    </main>
</body>
</html>
