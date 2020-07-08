<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function posts()
    {
        $query = request('query');
        $posts = Post::where("title", "like", "%$query%")->latest()->paginate(6);

        return view('posts.index', compact('posts'));
    }
}
