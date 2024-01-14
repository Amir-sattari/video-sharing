<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Utilities\ImageUploader;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Video\StoreRequest;
use App\Http\Requests\Video\UpdateRequest;

class VideoController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('videos.create',compact('categories'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $createdVideo = $request->user()->videos()->create([
                'name' => $validatedData['name'],
                'category_id' => $validatedData['category_id'],
                'slug' => $validatedData['slug'],
                'url' => $validatedData['url'],
                'description' => $validatedData['description'],
                'thumbnail' => $validatedData['thumbnail'],
                'length' => $validatedData['length'],
            ]);

            if(!$createdVideo)
                throw new \Exception();

            $path = 'videos/' . $createdVideo->id . '/' . 'url_' . $validatedData['url']->getClientOriginalName();
            ImageUploader::upload($validatedData['url'],$path);
            return back()->with('success','ویدیو با موفقیت آپلود شد');

        } catch (\Exception $e) {
            return back()->with('failed',$e->getMessage());
        }
    }

    public function show(Video $video)
    {
        $relatedVideos = Video::all()->random(8);
        return view('videos.show',compact('video','relatedVideos'));
    }

    public function edit(Video $video)
    {
        $categories = Category::all();
        return view('videos.edit',compact('video','categories'));
    }

    public function update(UpdateRequest $request, Video $video)
    {
        try {
            $validatedData = $request->validated();

            $updatedVideo = $video->updated([
                'name' => $validatedData['name'],
                'category_id' => $validatedData['category_id'],
                'slug' => $validatedData['slug'],
                'length' => $validatedData['length'],
                'url' => $validatedData['url'],
                'description' => $validatedData['description'],
                'thumbnail' => $validatedData['thumbnail'],
            ]);
    
            if(!$updatedVideo)
                throw new \Exception();

            $path = 'videos/' . $video->id . '/' . 'url_' . $validatedData['url']->getClientOriginalName();
            ImageUploader::upload($validatedData['url'],$path);
            return redirect()->route('video.show',$video->slug)->with('success','ویدیو با موفقیت بروزرسانی شد');

        } catch (\Exception $e) {
            return back()->with('failed',$e->getMessage());
        }

    }
}
