<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class ShowPostController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Post $post)
    {
        // return view('post.show', [
        //     'post' => $post->load('comments', 'comments.user', 'user'),
        // ]);
        // dd($post->id);
        $comments = Comment::with(['post', 'post.user', 'user'])
            ->where('post_id', $post->id)
            ->get();
        // dd($comments);
        if ($comments->count() == 0) {
            return view('post.show', [
                'post' => $post->load('comments', 'comments.user', 'user'),
                'comments' => $post->comments,
            ]);
        } else {
            return view('post.show', [
                'post' => $comments[0]->post,
                'comments' => $comments,
            ]);
        }
    }
}
