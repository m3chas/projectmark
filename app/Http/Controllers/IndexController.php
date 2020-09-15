<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Show the index of SquareBlog with recent posts from the community.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Let's get all post with published status 1, and order by publication_date.
        // Let's include also, a pagination by 10/page.
        // Also, I've included the request to sort by publication_date.
        $posts = Post::where('published', 1)
               ->orderBy('publication_date', $request->sort ? $request->sort : 'Desc')
               ->paginate(10);

        // Let's return our view, called welcome with the posts data to it.
        return view('welcome', [
            'posts' => $posts
        ]);
    }
}
