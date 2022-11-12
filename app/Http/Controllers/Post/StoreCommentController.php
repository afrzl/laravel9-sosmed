<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class StoreCommentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Post $post)
    {
        $data = $request->validate([
            'body' => ['required', 'min:8'],
        ]);

        $data['user_id'] = $request->user()->id;

        $post->comments()->create($data);

        return redirect()
            ->back()
            ->with('success', 'Comment has been added!');
    }
}
