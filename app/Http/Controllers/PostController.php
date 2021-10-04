<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Plugin\Addon;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10); 
        $posts = Addon::isEmpty($posts);
        return view('posts.index', compact('posts'));
    }
}
