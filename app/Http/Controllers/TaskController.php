<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TaskController extends Controller
{
    /**
     * function for task 1
     */
    function get_posts() {
        $posts = Http::get('https://jsonplaceholder.typicode.com/posts')
            ->collect()
            ->where('userId', 8);

        return view('task-1', compact('posts'));
    }

    /**
     * function for task 2
     */
    function get_liked_posts() {
        return DB::select('select post
                                from likes
                                inner join blog_posts
                                on likes.blog_id = blog_posts.blog_id
                                where likes.user_id = ? and likes.like = ?', [8, 1]);
    }

    /**
     * function for task 3
     */
    function post_data(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
            'likes' => 'required|numeric|min:1|max:10',
            'reposts' => 'required|numeric|min:1|max:10',
            'views' => 'required|numeric|min:1|max:10'
        ]);

        return 'Request successfully sent!';
    }
}
