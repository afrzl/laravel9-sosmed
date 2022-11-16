<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class TimelineController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $posts = Post::with('user')
            ->withCount('comments')
            ->latest('id')
            ->simplePaginate(15);
        // dd($posts);
        return view('dashboard', [
            'posts' => $posts,
        ]);
    }
}
