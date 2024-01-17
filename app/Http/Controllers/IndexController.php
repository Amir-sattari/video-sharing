<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $latestVideos = Video::with(['user','category'])->latest()->take(6)->get();
        $mostPopularVideos = Video::with(['user','category'])->get()->random(6);
        $mostViewedVideos = Video::with(['user','category'])->get()->random(6);

        return view('index',compact('latestVideos','mostPopularVideos','mostViewedVideos'));
    }    
}
