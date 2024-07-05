<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts= Post::all();
         return  response()->json([
        'posts'=>$posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>['required','string','max:100'],
            'body'=>['required','string','max:500']
        ]);

      $post=  Post::create([
            'title'=>$request->title,
            'body'=>$request->body
        ]);

        return response()->json([
            'message'=>'Post created successfully',
            'post'=>$post
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        if(!$post){
            return response()->json([
                'message'=>'No Post Found'

            ]);
        }
        return response()->json([
            "post"=>$post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>['required','string','max:100'],
            'body'=>['required','string','max:500']
        ]);
        $post=Post::find($id);
        $post=$post->update([
            'title'=>$request->title,
            'body'=>$request->body,
        ]);

        return response()->json([
            'post'=>$post,
            'message'=>'Post updated successfully'
        ]);



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post=Post::findOrFail($id);
        $post->delete();
        return response()->json([

            'message'=>'Post deleted successfully'
        ]);
    }
}
