@extends('videos.auth-layout')
@section('class-body', 'log-in-page')
@section('content')
<div id="log-in" class="site-form log-in-form">

    <div id="log-in-head">
        <h1>ورود</h1>
        <div id="logo"><a href="{{ route('home.index') }}"><img src="/img/logo.png" alt=""></a></div>
    </div>

    <div class="form-output">
        @include('errors.message')
        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            <div class="form-group label-floating">
                <label class="control-label">ایمیل</label>
                <input class="form-control" name="email" placeholder="" type="email">
            </div>
            <div class="form-group label-floating">
                <label class="control-label">رمز عبور</label>
                <input class="form-control" name="password" placeholder="" type="password">
            </div>

            <div class="remember">
                <div class="checkbox">
                    <label>
                        <input name="remember" type="checkbox">
                        مرا به خاطر بسپار
                    </label>
                </div>
                <a href="#" class="forgot">رمز عبورم را فراموش کرده ام</a>
            </div>

            <button class="btn btn-lg btn-primary full-width">ورود</button>

            <div class="or "></div>

            <p> حساب کاربری ندارید؟<a href="{{ route('register.create') }}"> ثبت نام کنید</a> </p>
        </form>
    </div>
</div>
@endsection
