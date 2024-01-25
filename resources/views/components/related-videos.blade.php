<div id="related-posts">

    <!-- video item -->
    @foreach($videos as $video)
    <div class="related-video-item">
        <div class="thumb">
            <small class="time">{{ $video->LengthForHuman }}</small>
            <a href="{{ route('video.show',$video->slug) }}"><img src="{{ $video->video_thumbnail }}" alt=""></a>
        </div>
        <a href="{{ route('video.show',$video->slug) }}" class="title">{{ $video->name }}</a>
        <a class="channel-name" href="#">{{ $video->owner_name }}<span><i class="fa fa-check-circle"></i></span></a>
        <span class="date"><i class="fa fa-tag"></i>{{ $video->category_name }}</span>

    </div>
    @endforeach

    <!-- // video item -->

</div>
