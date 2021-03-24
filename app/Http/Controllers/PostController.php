<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body'  => 'required',
        ]);

        $id = Auth::id();
        //インスタンス作成
        $post = new Post();
        
        $post->body = $request->body;
        $post->user_id = $id;

        $post->save();

       return redirect()->to('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $usr_id = $post->user_id;
        $user = DB::table('users')->where('id', $usr_id)->first();
        

        return view('posts.detail',['post' => $post,'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = \App\Models\Post::findOrFail($id);

        return view('posts.edit',['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'body'  => 'required',
        ]);

        $id = $request->post_id;

        if(Auth::id() !== $id){
            return abort(404);
        }
        
        //レコードを検索
        $post = Post::findOrFail($id);
        
        $post->body = $request->body;
        
        //保存（更新）
        $post->save();
        
        return redirect()->to('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = \App\Models\Post::find($id);

        if(Auth::id() !== $post->user_id){
            return abort(404);
        }

        //削除
        $post->delete();

        return redirect()->to('/posts');
    }
}
