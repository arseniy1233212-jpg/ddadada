@extends('layouts.app')

@section('content')
    <span class="eyebrow">{{ $apartment['code'] }}</span>
    <h1>{{ $apartment['address'] }}</h1>

    <div class="detail">
        <div class="panel">
            <div class="price">{{ number_format($apartment['price'], 2, ',', ' ') }} ₸</div>
            <p style="color:var(--muted);margin-top:8px">
                ≈ {{ number_format($apartment['price'] / $apartment['area'], 0, ',', ' ') }} ₸ за м²
            </p>
            @if ($apartment['is_new_building'])
                <span class="badge" style="display:inline-block;margin-top:18px">Новостройка</span>
            @endif
        </div>
        <dl class="panel rows">
            <div><dt>Код</dt><dd>{{ $apartment['code'] }}</dd></div>
            <div><dt>Адрес</dt><dd>{{ $apartment['address'] }}</dd></div>
            <div><dt>Район</dt><dd>{{ $apartment['district'] }}</dd></div>
            <div><dt>Площадь</dt><dd>{{ $apartment['area'] }} м²</dd></div>
            <div><dt>Комнат</dt><dd>{{ $apartment['rooms'] }}</dd></div>
            <div><dt>Цена</dt><dd>{{ number_format($apartment['price'], 2, ',', ' ') }} ₸</dd></div>
            <div><dt>Новостройка</dt><dd>{{ $apartment['is_new_building'] ? 'Да' : 'Нет' }}</dd></div>
        </dl>
    </div>
    <a class="back" href="{{ route('catalog.index') }}">&larr; К каталогу</a>
@endsection
