<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryVideoController extends Controller
{
    public function index(Request $request, Category $category)
    {
        $videos = $category->videos()
            ->filters($request->all())
            ->paginate()
            ->withQueryString();
        $title = $category->name;

        return view('videos.index',compact('videos','title'));
    }
}
