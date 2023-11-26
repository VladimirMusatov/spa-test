<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class MainController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('dashboard', compact('posts'));
    }

    public function show($id)
    {
        $post_exist = Post::where('id', $id)->exists();

        if(!$post_exist)
        {
            return redirect()->route('dashboard');
        }


        $post = Post::where('id', $id)->first();

        return view('show', compact('post'));
    }

    public function create()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'text' => 'required',
        ]);


        $title = $request->title;
        $text = $request->text;

        Post::create(['title' => $title, 'text' => $text]);

        return response()->json([            
            'success' => true,
            'message' => 'The post was successfully created',
        ]);
    }

    public function delete($id)
    {

        // Post::where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'The post was successfully deleted',
        ]);
    }

    public function edit($id)
    {
        $post = Post::where('id', $id)->first();

        return view('edit_post', compact('post'));
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'text' => 'required',
        ]);

        $title = $request->title; 
        $text = $request->text;
        $id = $request->id;

        $post = Post::where('id', $id)->first();

        $post->update(['title' => $title , 'text' => $text]);

        return response()->json([            
            'success' => true,
            'message' => 'The post has been successfully updated',
            'post' => $post,
        ]);

    }
}
