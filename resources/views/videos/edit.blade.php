@extends('videos.layout')

@section('content')

<div id="all-output" class="col-md-10 upload">
    <div id="upload">
        <div class="row">
            <!-- upload -->
            <div class="col-md-8">
                @include('errors.message')
                <h1 class="page-title"><span>آپلود</span> فیلم</h1>
                <form action="{{ route('video.update',$video->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6">
                            <label>عنوان</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name',$video->name) }}" placeholder="عنوان">
                        </div>
                        <div class="col-md-6">
                            <label>برچسب</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug',$video->slug) }}" placeholder="برچسب ها">
                        </div>
                        <div class="col-md-6">
                            <label>دسته بندی</label>
                            <select class="form-control" name="category_id">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $video->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>آپلود فیلم</label>
                            <input id="upload_file" name="file" type="file" class="form-control" value="{{ $video->video_url }}">
                        </div>
                        <div class="col-md-12">
                            <label>توضیحات</label>
                            <textarea class="form-control" name="description" rows="4" placeholder="توضیح">{{ old('description',$video->description) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" id="contact_submit" class="btn btn-dm">ذخیره</button>
                        </div>
                    </div>
                </form>
            </div><!-- // col-md-8 -->

            <div class="col-md-4">
                <a href="#"><img src="{{ $video->video_thumbnail }}" alt=""></a>
            </div><!-- // col-md-8 -->
            <!-- // upload -->
        </div><!-- // row -->
    </div><!-- // upload -->
</div>

@endsection
