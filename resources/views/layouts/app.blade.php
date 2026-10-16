<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Без названия' }} — {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/estate.css') }}?v={{ filemtime(public_path('css/estate.css')) }}">
</head>
<body>
    <header class="nav">
        <div class="wrap">
            <a class="logo" href="{{ route('catalog.index') }}">ESTATE<i>.</i>{{ strtoupper(config('lab.slug')) }}</a>
            <nav class="nav-links">
                <a href="{{ route('catalog.index') }}">Каталог</a>
                <a href="{{ route('catalog.district') }}">Районы</a>
                <a href="{{ route('catalog.stats') }}">Статистика</a>
                <a href="{{ route('feedback.form') }}">Обратная связь</a>
            </nav>
        </div>
    </header>

    <main class="wrap">
        @if (session('status'))
            <div class="alert">{{ session('status') }}</div>
        @endif
        @yield('content')
    </main>

    <footer>
        <div class="wrap">
            <span>{{ config('lab.student') }} ({{ config('lab.group') }}, N = {{ config('lab.number') }})</span>
            <span>код занятия: <strong>{{ config('lab.code') }}</strong></span>
            <span>{{ now()->format('d.m.Y H:i:s') }}</span>
        </div>
    </footer>
</body>
</html>
