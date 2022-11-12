<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class StorePostController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'body' => ['required', 'min:8'],
        ]);

        $request
            ->user()
            ->posts()
            ->create($data);

        return redirect()
            ->back()
            ->with('success', 'Post created successfully!');
    }
}
