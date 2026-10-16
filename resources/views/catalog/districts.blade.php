@extends('layouts.app')

@section('content')
    <span class="eyebrow">Районы</span>
    <h1>{{ $title }}</h1>
    <div class="grid">
        @foreach ($districts as $district)
            <a class="card" href="{{ route('catalog.district', $district) }}">
                <div class="num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                <h3>{{ $district }}</h3>
                <span class="chip">квартир: {{ $counts[$district] }}</span>
            </a>
        @endforeach
    </div>
@endsection
