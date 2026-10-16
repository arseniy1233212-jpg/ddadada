@extends('layouts.app')

@section('content')
    <span class="eyebrow">Контакты</span>
    <h1>{{ $title }}</h1>
    <form method="POST" action="{{ route('feedback.send') }}" class="form">
        @csrf
        <input type="text" name="name" placeholder="Имя">
        <textarea name="message" rows="4" placeholder="Сообщение"></textarea>
        <button class="btn">Отправить</button>
    </form>
@endsection
