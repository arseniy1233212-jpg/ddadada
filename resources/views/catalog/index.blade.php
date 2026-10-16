@extends('layouts.app')

@section('content')
    <span class="eyebrow">Агентство недвижимости</span>
    <h1>{{ $title }}</h1>

    <form method="GET" action="{{ route('catalog.index') }}" class="filter">
        <input type="text" name="q" value="{{ $search }}" placeholder="Поиск по адресу...">
        <select name="sort">
            <option value="address" @selected($sort === 'address')>По адресу</option>
            <option value="area" @selected($sort === 'area')>По площади</option>
            <option value="price" @selected($sort === 'price')>По цене</option>
        </select>
        <button class="btn">Найти</button>
    </form>

    <div class="grid">
        @forelse ($apartments as $apartment)
            <article class="card">
                <div class="card-top">
                    <span class="num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    @if ($apartment['is_new_building'])
                        <span class="badge">Новостройка</span>
                    @endif
                </div>
                <h3><a href="{{ route('catalog.show', ['id' => $apartment['id']]) }}">{{ $apartment['address'] }}</a></h3>
                <a class="chip" href="{{ route('catalog.district', $apartment['district']) }}">{{ $apartment['district'] }}</a>
                <div class="meta">
                    <div><b>{{ $apartment['area'] }}</b> м²</div>
                    <div><b>{{ $apartment['rooms'] }}</b> комн.</div>
                </div>
            </article>
        @empty
            <div class="empty">Ничего не найдено.</div>
        @endforelse
    </div>
@endsection
