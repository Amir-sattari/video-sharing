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
                            <label>دسته بندی</label>
                            <input type="text" name="category" class="form-control" value="{{ old('category',$video->category) }}" placeholder="دسته بندی">
                        </div>
                        <div class="col-md-6">
                            <label>برچسب ها</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug',$video->slug) }}" placeholder="برچسب ها">
                        </div>
                        <div class="col-md-6">
                            <label>مدت زمان</label>
                            <input type="text" name="length" class="form-control" value="{{ old('length',$video->length) }}" placeholder="مدن زمان">
                        </div>
                        <div class="col-md-6">
                            <label>آپلود فیلم</label>
                            <input id="upload_file" name="url" type="file" class="file" value="{{ $video->url }}">
                        </div>
                        <div class="col-md-12">
                            <label>توضیحات</label>
                            <textarea class="form-control" name="description" rows="4" placeholder="توضیح">{{ old('description',$video->description) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label>تصویر</label>
                            <input id="featured_image" name="thumbnail" type="file" class="file" value="{{ $video->thumbnail }}">
                        </div>
                        <div class="col-md-6">
                            <button type="submit" id="contact_submit" class="btn btn-dm">ذخیره</button>
                        </div>
                    </div>
                </form>
            </div><!-- // col-md-8 -->

            <div class="col-md-4">
                <a href="#"><img src="{{ $video->thumbnail }}" alt=""></a>
            </div><!-- // col-md-8 -->
            <!-- // upload -->
        </div><!-- // row -->
    </div><!-- // upload -->
</div>

@endsection
