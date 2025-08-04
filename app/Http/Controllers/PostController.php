<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // return response()->json(Post::orderBy('priority', 'desc')->get());
        return PostResource::collection(Post::orderBy('priority', 'desc')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'priority' => 'integer|min:0|max:2',
            'user_id' => 'required|exists:users,id',
            'tag_id' => 'required|exists:tags,id',
        ]);

        $post = Post::create(
        $request->only(['title', 'content', 'priority', 'user_id']));   
        foreach ($request->tag_id as $tagId) {
            $post->tags()->attach($tagId);
        }    


        // return response()->json($post, 201);
        return new PostResource($post);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // return response()->json($post);
        return new PostResource($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->update($request->only(['title', 'content']));

        // return response()->json($post);
        return new PostResource($post);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
