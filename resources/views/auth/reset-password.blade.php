@extends('videos.auth-layout')
@section('content')
<div id="log-in" class="site-form log-in-form">

    <div id="log-in-head">
        <h1>بازیابی رمز عبور</h1>
        <div id="logo"><a href="{{ route('home.index') }}"><img src="/img/logo.png" alt=""></a></div>
    </div>

    <div class="form-output">
        @include('errors.message')
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="form-group; label-floating">
                <label class="control-label">ایمیل</label>
                <input name="email" type="email" class="form-control" placeholder="" value="{{ $request->email }}">
            </div>

            <div class="form-group; label-floating">
                <label class="control-label">رمز عبور</label>
                <input name="password" type="password" class="form-control" placeholder="" value="{{ $request->email }}">
            </div>

            <div class="form-group; label-floating">
                <label class="control-label">تکرار رمز عبور</label>
                <input name="password_confirmation" type="password" class="form-control" placeholder="" value="{{ $request->email }}">
            </div>

            <button type="submit" class="btn btn-lg btn-primary full-width">تغییر</button>
        </form>
    </div>
</div>
