<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\Comment\StoreRequest;

class CommentController extends Controller
{
    public function store(StoreRequest $request,Video $video)
    {
        try {

            $createdComment = $video->comments()->create([
                'user_id' => auth()->id(),
                'body' => $request->body,
            ]);
    
            if(!$createdComment)
                throw new \Exception();
    
            return back()->with('success','نظر شما با موفقیت ثبت شد');

        } catch (\Exception $e) {

            return back()->with('failed',$e->getMessage());

        }

    }
}
