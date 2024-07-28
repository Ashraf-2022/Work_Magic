<?php

namespace App\Http\Controllers\Category;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category($name)
    {
        $post_category = Post::where(['category' => $name])
            ->take(5)
            ->orderBy('created_at', 'desc')
            ->get();
        $pop_post = Post::take(3)->orderBy('id', 'desc')->get();
        $cat_post = DB::table('categories')
            ->join('posts', 'posts.category', '=', 'categories.name')
            ->select(
                'categories.name AS name',
                'categories.id AS id',
                DB::raw('COUNT(posts.category) AS total')
            )
            ->groupBy('posts.category')
            ->get();
        return view('Categories.category', compact('post_category', 'pop_post', 'cat_post', 'name'));
    }
}
