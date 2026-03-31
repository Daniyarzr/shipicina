<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админка | Татьяна Щипицына</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body class="admin-page">
    <header class="admin-header">
        <div class="container admin-header__inner">
            <h1>Админ-панель сайта</h1>
            <form action="{{ route('admin.logout') }}" method="post">
                @csrf
                <button class="btn btn--ghost" type="submit">Выйти</button>
            </form>
        </div>
    </header>

    <main class="container admin-main">
        @if (session('admin_success'))
            <div class="alert alert--success">{{ session('admin_success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert--error">
                <p>Есть ошибки в форме:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="admin-section">
            <h2>Управление текстом и результатами</h2>
            <form class="form" action="{{ route('admin.content.update') }}" method="post">
                @csrf

                <label class="field">
                    <span>Заголовок баннера</span>
                    <textarea name="hero_title" rows="3" required>{{ old('hero_title', $content['hero']['title']) }}</textarea>
                </label>

                <label class="field">
                    <span>Подзаголовок баннера</span>
                    <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $content['hero']['subtitle']) }}" required>
                </label>

                <label class="field">
                    <span>Заголовок блока “Обо мне”</span>
                    <input type="text" name="about_title" value="{{ old('about_title', $content['about']['title']) }}" required>
                </label>

                <label class="field">
                    <span>Абзацы “Обо мне” (каждый с новой строки)</span>
                    <textarea name="about_paragraphs" rows="6">{{ old('about_paragraphs', implode("\n", $content['about']['paragraphs'])) }}</textarea>
                </label>

                <h3>Статистика на главной</h3>
                <div class="admin-grid-3">
                    @foreach($content['stats'] as $index => $stat)
                        <div class="card">
                            <label class="field">
                                <span>Значение</span>
                                <input type="text" name="stats[{{ $index }}][value]" value="{{ old("stats.$index.value", $stat['value']) }}" required>
                            </label>
                            <label class="field">
                                <span>Подпись</span>
                                <input type="text" name="stats[{{ $index }}][label]" value="{{ old("stats.$index.label", $stat['label']) }}" required>
                            </label>
                        </div>
                    @endforeach
                </div>

                <h3>Блок “Результаты в цифрах”</h3>
                <div class="admin-results">
                    @foreach($content['results'] as $index => $result)
                        <div class="card">
                            <label class="field">
                                <span>Компания</span>
                                <input type="text" name="results[{{ $index }}][name]" value="{{ old("results.$index.name", $result['name']) }}" required>
                            </label>
                            <label class="field">
                                <span>Результат</span>
                                <textarea name="results[{{ $index }}][result]" rows="3" required>{{ old("results.$index.result", $result['result']) }}</textarea>
                            </label>
                            <label class="field">
                                <span>Логотип (путь в public)</span>
                                <input type="text" name="results[{{ $index }}][logo]" value="{{ old("results.$index.logo", $result['logo']) }}" required>
                            </label>
                            <p class="admin-help">Например: <code>images/favorit.webp</code></p>
                        </div>
                    @endforeach
                </div>

                <button class="btn" type="submit">Сохранить контент</button>
            </form>
        </section>

        <section class="admin-section">
            <h2>Замена изображений</h2>
            <form class="form" action="{{ route('admin.media.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label class="field">
                    <span>Баннер на главной</span>
                    <input type="file" name="banner_image" accept="image/*">
                </label>
                <label class="field">
                    <span>Фото в блоке “Обо мне”</span>
                    <input type="file" name="about_image" accept="image/*">
                </label>
                <label class="field">
                    <span>Favicon</span>
                    <input type="file" name="favicon_file" accept=".ico,.png,.jpg,.jpeg,.webp,.svg">
                </label>
                <button class="btn" type="submit">Загрузить изображения</button>
            </form>
        </section>

        <section class="admin-section">
            <h2>Заявки с сайта</h2>
            @if (count($leads) === 0)
                <p>Пока заявок нет.</p>
            @else
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Дата</th>
                                <th>Имя</th>
                                <th>Телефон</th>
                                <th>Ситуация</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leads as $lead)
                                <tr>
                                    <td>{{ $lead['created_at'] ?? '-' }}</td>
                                    <td>{{ $lead['name'] ?? '-' }}</td>
                                    <td>{{ $lead['phone'] ?? '-' }}</td>
                                    <td>{{ $lead['situation'] ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </main>
</body>
</html>
