@extends('videos.layout')

@section('content')

<div class="row">
    <!-- Watch -->
    <div class="col-md-8">
        <div id="watch">
            @include('errors.message')
            <!-- Video Player -->
            <h1 class="video-title">{{ $video->name }}</h1>
            <div class="video-code">
                <video controls style="height: 100%; width: 100%;">
                    <source src="{{ $video->video_url }}" type="video/mp4">
                </video>
            </div><!-- // video-code -->

            <div>
                <p>
                    {{ $video->description }}
                </p>
            </div>

            <div class="video-share">
                <ul class="like">
                    <li><a class="deslike" href="{{ route('dislikes.store', ['likeable_type' => 'video', 'likeable_id' => $video]) }}">{{ $video->dislikes_count }}<i class="fa fa-thumbs-down"></i></a></li>
                    <li><a class="like" href="{{ route('likes.store', ['likeable_type' => 'video', 'likeable_id' => $video]) }}">{{ $video->likes_count }}<i class="fa fa-thumbs-up"></i></a></li>
                </ul>
                <ul class="social_link">
                    <li><a class="facebook" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </li>
                    <li><a class="youtube" href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                    <li><a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    </li>
                    <li><a class="google" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                    </li>
                    <li><a class="twitter" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    </li>
                    <li><a class="rss" href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                </ul><!-- // Social -->
            </div><!-- // video-share -->
            <!-- // Video Player -->


            <!-- Chanels Item -->
            <div class="chanel-item">
                <div class="chanel-thumb">
                    <a href="#"><img src="{{ $video->owner_avatar }}" alt=""></a>
                </div>
                <div class="chanel-info">
                    <a class="title" href="#">{{ $video->owner_name }}</a>
                    <span class="subscribers">436,414 اشتراک</span>
                </div>
                <a href="#" class="subscribe">اشتراک</a>
            </div>
            <!-- // Chanels Item -->


            <!-- Comments -->
            <div id="comments" class="post-comments">
                <h3 class="post-box-title"><span>{{ $video->comments->count() }}</span> نظرات</h3>
                <ul class="comments-list">
                    @foreach($video->comments as $comment)
                    <li>
                        <div class="post_author">
                            <div class="img_in">
                                <a href="#"><img src="{{ $comment->user->gravatar}}" alt=""></a>
                            </div>
                            <a href="#" class="author-name">{{ $comment->user->name }}</a>
                            <time datetime="">{{ $comment->created_at }}</time>
                            <a class="deslike mr-5" style="color: #aaaaaa" href="{{ route('dislikes.store', ['likeable_type' => 'comment', 'likeable_id' => $comment]) }}">{{ $comment->dislikes_count }}<i class="fa fa-thumbs-down"></i></a>
                            <a class="like mr-5" style="color: #66c0c2" href="{{ route('likes.store', ['likeable_type' => 'comment', 'likeable_id' => $comment]) }}">{{ $comment->likes_count }}<i class="fa fa-thumbs-up"></i></a>

                        </div>
                        <p>{{ $comment->body }}</p>
                        <a href="#" class="reply">پاسخ</a>
                    </li>

                    {{-- <ul class="children">
                        <li>
                            <div class="post_author">
                                <div class="img_in">
                                    <a href="#"><img src="demo_img/c2.jpg" alt=""></a>
                                </div>
                                <a href="#" class="author-name">بهمن نجاتی</a>
                                <time datetime="2017-03-24T18:18">شهریور 27, 1397 - 11:00</time>
                            </div>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است</p>
                            <a href="#" class="reply">پاسخ</a>
                        </li>
                    </ul> --}}
                    @endforeach
                </ul>

                @auth
                <h3 class="post-box-title">ارسال نظرات</h3>
                <form action="{{ route('comments.store', $video) }}" method="POST">
                    @csrf
                    <textarea class="form-control" name="body" rows="8" id="Message" placeholder="پیام"></textarea>
                    <button id="contact_submit" class="btn btn-dm">ارسال پیام</button>
                </form>
                @endauth

                @guest
                <h3 class="post-box-title">ارسال نظرات</h3>
                برای ثبت نظر لطفا ثبت نام کنید و یا وارد حساب کاربری خود شوید
                @endguest
            </div>
            <!-- // Comments -->


        </div><!-- // watch -->
    </div><!-- // col-md-8 -->
    <!-- // Watch -->

    <!-- Related Posts-->
    <div class="col-md-4">
        <x-related-videos video="{{$video->id}}"></x-related-videos>
    </div><!-- // col-md-4 -->

    <!-- // Related Posts -->
</div><!-- // row -->

@endsection
