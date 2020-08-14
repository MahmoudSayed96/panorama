@extends('layouts.admin.auth')
@section('title','تسجيل الدخول')
@section('content')
    <div class="login-box">
        <form class="login-form" action="{{ route('admin.login') }}" method="POST">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>تسجيل الدخول</h3>
            <div class="form-group">
                <label class="control-label">البريد الإلكترونى</label>
                <input class="form-control @error('email') is-invalid @enderror" name="email" type="text" placeholder="mail@example.com" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="control-label">كلمة المرور</label>
                <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="كلمة المرور">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <div class="utility">
                <div class="animated-checkbox">
                    <label>
                    <input type="checkbox" name="remember_me"><span class="label-text">تذكرنى</span>
                    </label>
                </div>
                <p class="semibold-text mb-2"><a href="#" data-toggle="flip">?نسيت كلمة المرور</a></p>
                </div>
            </div>
            <div class="form-group btn-container">
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>تسجيل الدخول</button>
            </div>
        </form>
        @include('admin.auth._forget_password')
    </div>
@endsection
