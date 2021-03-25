@extends('layouts.app')
@section('title', 'detail page')

@section('content')
<div class="container">
    <div class="row">
        <!-- メイン -->
        <div class="col-10 col-md-6 offset-1 offset-md-3">
            <div class="card">
                <div class="card-header">
                   {{ $post->id }}
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $post->body }}</p>
                    <div class="card-footer bg-transparent"><span class="font-weight-bold">by:</span> {{ $user->name }}</div>
                    @auth
                    @if(Auth::id() == $post->user_id)
                        <a href="{{ url('posts/edit/'.$post->id) }}" class="btn btn-dark">編集する</a>
                    @endif
                    @endauth
                    <div class="row justify-content-center">
                        @if($post->users()->where('user_id', Auth::id())->exists())
                        <div class="col-md-3">
                        <form action="{{ route('unfavorites', $post) }}" method="POST">
                            @csrf
                            <input type="submit" value="&#xf164;いいね取り消す" class="fas btn btn-danger">
                        </form>
                        </div>
                        @else
                        <div class="col-md-3">
                        <form action="{{ route('favorites', $post) }}" method="POST">
                            @csrf
                            <input type="submit" value="&#xf164;いいね" class="fas btn btn-success">
                        </form>
                        </div>
                        @endif
                    </div>
                    <div class="row justify-content-center">
                        <p>いいね数：{{ $post->users()->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection