@extends('layouts.app')

@section('content')
    <span class="eyebrow">Аналитика</span>
    <h1>{{ $title }}</h1>
    <div class="stats">
        <div class="stat"><small>Всего квартир</small><strong>{{ $count }}</strong></div>
        <div class="stat"><small>Средняя цена</small><strong>{{ number_format($avg, 0, ',', ' ') }} ₸</strong></div>
        <div class="stat"><small>Минимум</small><strong>{{ number_format($min, 0, ',', ' ') }} ₸</strong></div>
        <div class="stat"><small>Максимум</small><strong>{{ number_format($max, 0, ',', ' ') }} ₸</strong></div>
    </div>
@endsection
