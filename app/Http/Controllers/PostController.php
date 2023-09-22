<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;


class PostController extends Controller
{
    public function index() {
        $posts = Post::latest()->get();

        return view('posts.index', compact('posts'));
    }

    public function create() {
        return view('posts.create');
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required|max:20',
            'content' => 'required|max:140',
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = Auth::user()->id;
        $img = $request->file('image');

        if (isset($img)) {
            $path = $img->store('img','public');
            if ($path) {
                $post->image = $path;
            }
        }
        $post->save();

        return redirect()->route('posts.index')->with('flash_message', '投稿が完了しました。');
    }

    public function show(Post $post) {
        $comments = $post->comments()->get();

        return view('posts.show', compact('post', 'comments'));
    }

    public function edit(Post $post) {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post) {
        $request->validate([
            'title' => 'required|max:20',
            'content' => 'required|max:140',
        ]);
        
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('posts.show', $post)->with('flash_message', '投稿を編集しました。');
    }

    public function destroy(Post $post) {
        $post->delete();

        return redirect()->route('posts.index')->with('flach_message', '投稿を削除しました。');
    }

}
