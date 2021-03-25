@extends('layouts.app')
@section('title', 'TOP page')

@section('content')
<div class="container">
    <div class="row">
        <!-- メイン -->
        <div class="col-10 col-md-8 offset-1 offset-md-2">
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th colspan="4">内容</th>
                    </tr>
                    
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->body }}<br>いいね数：{{ $post->users()->count() }}</td>
                        
                        <td>
                            <a href="{{ url('posts/'.$post->id) }}" class="btn btn-success">詳細</a>
                        </td>
                        <td>
                            @auth
                            @if(Auth::id() == $post->user_id)
                            <form action="/posts/delete/{{$post->id}}" method="POST">
                                {{ csrf_field() }}
                                <input type="submit" value="削除" class="btn btn-danger post_del_btn">
                            </form>
                        @endif
                        @endauth
                        </td>   
                    </tr>
                    @endforeach
                </tbody>
            </table> 
        </div>
    </div>
</div>
@endsection