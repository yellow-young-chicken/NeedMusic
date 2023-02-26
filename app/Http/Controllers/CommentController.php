<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post )
    {

        $request->validate([
            'body' => 'required',
        ]);

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->user_id = Auth::id();
        $comment->body = $request->body;
        $comment->save();

        return redirect()
            ->route('posts.show', $post);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()
            ->route('posts.show', $comment->post);
    }

}
