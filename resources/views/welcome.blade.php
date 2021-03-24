@extends('layouts.app')

@section('content')
    <!-- @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif -->

    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <h1 class="display-4">Laravel練習</h1>
            <p class="lead">掲示板アプリを作ってみました！</p>
            <a href="{{ route('login') }}" class="btn btn-primary">ログイン</a>
            <a href="{{ route('register') }}" class="btn btn-success">新規登録</a>
        </div>
    </div>

@endsection