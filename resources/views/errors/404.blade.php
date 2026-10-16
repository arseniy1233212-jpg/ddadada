@extends('layouts.app')

@section('content')
    <span class="eyebrow">Ошибка 404</span>
    <h1>Страница не найдена</h1>
    <div class="panel">
        <p style="color:var(--muted)">Запрошенный путь: <strong style="color:var(--b)">/{{ request()->path() }}</strong></p>
        <a class="back" href="{{ route('catalog.index') }}">&larr; К каталогу</a>
    </div>
@endsection
