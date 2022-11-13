<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class ReadNotificationCommentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Post $post, $notification)
    {
        auth()
            ->user()
            ->unreadNotifications->where('id', $notification)
            ->markAsRead();
        return redirect()->route('post.show', [
            'post' => $post->load('comments', 'comments.user', 'user'),
        ]);
    }
}
