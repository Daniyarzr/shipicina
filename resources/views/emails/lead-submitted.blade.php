<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Новая заявка</title>
</head>
<body style="font-family: Arial, sans-serif; color: #132421;">
    <h2>Новая заявка с сайта</h2>
    <p><strong>Имя:</strong> {{ $lead['name'] }}</p>
    <p><strong>Телефон:</strong> {{ $lead['phone'] }}</p>
    <p><strong>Ситуация / пожелания:</strong><br>{{ $lead['situation'] !== '' ? $lead['situation'] : 'Не указано' }}</p>
    <p><strong>Дата:</strong> {{ $lead['created_at'] }}</p>
</body>
</html>
