<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{

    public function index($id)
    {
        try {
            $post = Post::findOrFail($id);
        } catch (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $th) {
            // throw $th;
            return view("404");
            abort(404, "Page not found");
        }
        return view('post', compact('post'));
    }


    public function showAllPosts()
    {
        $posts = Post::all();
        return view('posts', compact('posts'));
    }


    public function create()
    {
        return view('create-post');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $post = Post::create([
            'title' => request()->title,
            'body' => request()->body,
        ]);

        return redirect('/posts');
    }
}
