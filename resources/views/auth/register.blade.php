@extends('videos.auth-layout')
@section('class-body', 'sing-up-page')
@section('content')
<div id="log-in" class="site-form log-in-form">

    <div id="log-in-head">
        <h1>ثبت نام</h1>
        <div id="logo"><a href="{{ route('home.index') }}"><img src="/img/logo.png" alt=""></a></div>
    </div>

    <div class="form-output">
    @include('errors.message')
        <form action="{{ route('register.store') }}" method="POST">
        @csrf
            <div class="form-group label-floating">
                <label class="control-label">نام</label>
                <input class="form-control" name="name" placeholder="" type="name">
            </div>
            <div class="form-group label-floating">
                <label class="control-label">ایمیل</label>
                <input class="form-control" name="email" placeholder="" type="email">
            </div>
            <div class="form-group label-floating">
                <label class="control-label">رمز عبور</label>
                <input class="form-control" name="password" placeholder="" type="password">
            </div>

            <div class="form-group label-floating">
                <label class="control-label">تأیید رمز عبور</label>
                <input class="form-control" name="password_confirmation" placeholder="" type="password">
            </div>

            {{-- <div class="form-group label-floating is-select">
                <label class="control-label">جنسیت</label>
                <select class="selectpicker form-control">
                    <option value="MA">مرد</option>
                    <option value="FE">زن</option>
                </select>
            </div> --}}

            <div class="remember">
                <div class="checkbox">
                    <label>
                        <input name="optionsCheckboxes" type="checkbox">
                            مرا به خاطر بسپار       
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-lg btn-primary full-width">ثبت نام</button>

            <div class="or"></div>

            <p>حساب کاربری دارید؟<a href="{{ route('login.create') }}">ورود!</a> </p>
        </form>
    </div>
</div>
@endsection