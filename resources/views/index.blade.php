@extends('videos.layout')

@section('content')

<h1 class="new-video-title"><i class="fa fa-bolt"></i>آخرین ویدیو ها</h1>
<div class="row">

    @foreach($latestVideos as $video)
        <x-video-box :video="$video"></x-video-box>
    @endforeach
</div>

<h1 class="new-video-title"><i class="fa fa-bolt"></i>پربازدیدترین ها</h1>
<div class="row">

    @foreach($mostViewedVideos as $video)
        <x-video-box :video="$video"></x-video-box>
    @endforeach

</div>

<h1 class="new-video-title"><i class="fa fa-bolt"></i>محبوبترین ها</h1>
<div class="row">

    @foreach($mostPopularVideos as $video)
        <x-video-box :video="$video"></x-video-box>
    @endforeach
</div>

@endsection
