<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class FrontBlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::all();
        return view('front-end.blog.index', compact('blogs'));
    }

    public function detail(Request $request, $id)
    {
        $blog = blog::findOrFail($id);
        $blogs = Blog::where('id', '!=', $id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('front-end.blog.detail', compact('blog', 'blogs'));
    }
}
