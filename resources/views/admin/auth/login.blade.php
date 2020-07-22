@extends('layouts.dashboard.auth')
@section('title','تسجيل الدخول')
@section('content')
    <div class="login-box">
        <form class="login-form" action="#">
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
            <div class="form-group">
                <label class="control-label">USERNAME</label>
                <input class="form-control" type="text" placeholder="Email" autofocus>
            </div>
            <div class="form-group">
                <label class="control-label">PASSWORD</label>
                <input class="form-control" type="password" placeholder="Password">
            </div>
            <div class="form-group">
                <div class="utility">
                <div class="animated-checkbox">
                    <label>
                    <input type="checkbox"><span class="label-text">Stay Signed in</span>
                    </label>
                </div>
                <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>
                </div>
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
            </div>
        </form>
        @include('dashboard.auth._forget_password')
    </div>
@endsection
