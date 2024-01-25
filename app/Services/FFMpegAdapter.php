<?php

namespace App\Services;

use FFMpeg\Coordinate\TimeCode;
use Illuminate\Support\Facades\Storage;

class FFMpegAdapter
{
    public function __construct(public string $path)
    {
        $ffmpeg = \FFMpeg\FFMpeg::create([
            'ffmpeg.binaries'  => 'c:\ffmpeg\bin\ffmpeg.exe',
            'ffprobe.binaries' => 'c:\ffmpeg\bin\ffprobe.exe' 
        ]);

        $this->ffmpeg = \FFMpeg\FFMpeg::create();
        $this->ffprobe = \FFMpeg\FFProbe::create();
        $this->video_probe = $this->ffprobe->format(Storage::path($path));
        $this->video = $this->ffmpeg->open(Storage::path($path));
    }

    public function getDuration()
    {
        return (int) $this->video_probe->get('duration');
    }

    public function getFrame()
    {
        $frame = $this->video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(1));
        $file_name = pathinfo($this->path,PATHINFO_FILENAME) . '.jpg';
        $storage_path = storage_path('app/public/' . $file_name);
        $frame->save($storage_path);
        return $file_name;
    }
}