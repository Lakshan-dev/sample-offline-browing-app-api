<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::all();
            return response()->json(['data'=>$posts],200);
        }catch(\Exception $e){
            return response()->json(['error'=>'Something went wrong!'],500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:50',
                'subTitle' => 'string',
                'body' => 'required|string',
            ]);
            $post = Post::create($request->all());
            return response()->json(['data'=>$post],200);
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }

    public function show($id)
    {
        try {
            $post = Post::find($id);
            if (!$post){
                return response()->json(['error'=>'Post not found!'],500);
            }
            return response()->json(['data'=>$post],200);
        }catch(\Exception $e){
            return response()->json(['error'=>'Something went wrong!'],500);
        }
    }
    public function update($id, Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:50',
                'subTitle' => 'string',
                'body' => 'required|string',
            ]);
            $post = Post::find($id);
            if (!$post){
                return response()->json(['error'=>'Post not found!'],500);
            }
            $post->update([
                'title' => $request->title,
                'subTitle' => $request->subTitle,
                'body' => $request->body
            ]);
            return response()->json(['data'=>'Post updated!'],200);
        }catch(\Exception $e){
            return response()->json(['error'=>'Something went wrong!'],500);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::find($id);
            if (!$post){
                return response()->json(['error'=>'Post not found!'],500);
            }
            $post->delete();
            return response()->json(['data'=>'Post removed!'],200);
        }catch(\Exception $e){
            return response()->json(['error'=>'Something went wrong!'],500);
        }
    }
}
