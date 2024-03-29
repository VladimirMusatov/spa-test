<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class MainController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function posts()
    {
        $posts = Post::all();

        return response()->json($posts);
    }

    public function get_post($id)
    {

        $post = Post::where('id', $id)->first();

        return response()->json($post);

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

        Post::where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'The post was successfully deleted',
        ]);
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

    public function recaptcha(Request $request)
    {
        $data = [
            'site_key' => config('captcha.sitekey'),
        ];

        return response()->json($data);
    }
}
