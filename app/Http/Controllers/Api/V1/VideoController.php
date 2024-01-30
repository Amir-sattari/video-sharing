<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Services\VideoService;
use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use App\Http\Requests\Video\StoreRequest;
use App\Http\Requests\Video\UpdateRequest;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $videos = Video::filters($request->all())->paginate(10);
        return VideoResource::collection($videos);
    }

    public function store(StoreRequest $request)
    {
        (new VideoService)->create(User::find(13),$request->all());
        return response()->json([
            'message' => 'Video Created',
        ], 201);
    }

    public function show(Video $video)
    {
        return response()->json([
            'data' => new VideoResource($video),
        ]);
    }

    public function update(UpdateRequest $request, Video $video)
    {
        $this->authorize('update',$video);
        (new VideoService)->update($video, $request->all());

        return response()->json([
            'message' => 'Video Updated',
        ], 200);
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return response()->json([
            'message' => 'Video Deleted',
        ],200);
    }
}
