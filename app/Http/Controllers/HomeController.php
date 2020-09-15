<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show users pots and links to add new ones.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get the currently authenticated user...
        $user = Auth::user();

        // Let's get all user's post with published status 1, and order by publication_date.
        // Let's include also, a pagination by 10/page.
        $posts = $user->posts()->where('published', 1)
               ->orderBy('publication_date', 'desc')
               ->paginate(10);

        // Let's return our view, called welcome with the posts data to it.
        return view('home', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
