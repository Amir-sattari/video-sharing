<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckVerifyEmail;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Utilities\ImageUploader;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Video\StoreRequest;
use App\Http\Requests\Video\UpdateRequest;
use App\Services\FFMpegAdapter;
use App\Services\VideoService;
use Illuminate\Auth\Access\Gate as AuthAccessGate;
use Illuminate\Contracts\Auth\Access\Gate as AccessGate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function __construct(private VideoService $videoService)
    {
    }
    public function create()
    {
        $categories = Category::all();
        return view('videos.create',compact('categories'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $createdVideo = $this->videoService->create($request->user(),$request->all());

            if(!$createdVideo)
                throw new \Exception();

            return back()->with('success','ویدیو با موفقیت آپلود شد');

        } catch (\Exception $e) {
            return back()->with('failed',$e->getMessage());
        }
    }

    public function show(Video $video)
    {
        $video->load('comments.user');
        $relatedVideos = Video::all()->random(8);
        return view('videos.show',compact('video','relatedVideos'));
    }

    public function edit(Video $video)
    {
        $this->authorize('update',$video);

        $categories = Category::all();
        return view('videos.edit',compact('video','categories'));
    }

    public function update(UpdateRequest $request, Video $video)
    {
        $this->authorize('update',$video);

        try {
            $updatedVideo = $this->videoService->update($video, $request->all());
    
            if(!$updatedVideo)
                throw new \Exception();

            return redirect()->route('video.show',$video->slug)->with('success','ویدیو با موفقیت بروزرسانی شد');

        } catch (\Exception $e) {
            return back()->with('failed',$e->getMessage());
        }

    }
}
