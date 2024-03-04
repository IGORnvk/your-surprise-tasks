<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TaskController extends Controller
{
    function get_posts() {
        $posts = Http::get('https://jsonplaceholder.typicode.com/posts')
            ->collect()
            ->where('userId', 8);

        return view('task-1', compact('posts'));
    }
}
