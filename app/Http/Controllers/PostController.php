<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{



    function index()
    {
        $posts = Post::orderby('id', 'DESC')->paginate(3);
        return view("posts.index", ["posts" => $posts]);
    }

    function create()
    {
        return view("posts.create", ['users' => User::all()]);
    }

    function store(Request $request_data)
    {
        $data = $request_data->all();
        // dd($request_data->file('image')->getMimeType());
        // dd($request_data);
        // post::create([
        //     // 'title' => 'hello from post method',
        //     // 'description' => 'new description'

        //     'title' => $data['title'],
        //     'description' => $data['description']
        // ]);

        $img = $request_data->file('image');
        $ext = $img->getClientOriginalExtension();
        // dd($ext);
        $name = 'post' . uniqid() . ".$ext";
        $img->move(public_path('uploads/posts'), $name);
        // dd($data, $name);


        $request_data->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:8'],
            // 'image' => 'mimetypes:image/jpeg,image/png,image/jpg',
        ]);

        post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['user_id'],
            'image' => $name
        ]);


        return to_route("posts.index");
    }

    function show($post)
    {
        $data = Post::find($post);
        return view("posts.post", ["post" => $data]);
    }

    function edit($post)
    {

        $data = Post::find($post);
        return view("posts.edit", ["post" => $data]);
    }

    function update($post)
    {
        $updatedpost = Post::find($post);
        $updatedpost->title = request("title");
        $updatedpost->description = request("description");
        $updatedpost->save();
        return to_route("posts.index");
    }

    function destroy($id)
    {
        $post = Post::findOrfail($id);
        // dd($post->image);
        if ($post->image !== null)
            unlink(public_path('uploads/posts/') . $post->image);
        $post->delete();
        return to_route("posts.index");
    }
}
