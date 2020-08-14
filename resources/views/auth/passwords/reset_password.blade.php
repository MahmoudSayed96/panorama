@extends('layouts.admin.auth')
@section('title','تعيين كلمة مرور جديدة')
@section('content')
    <div class="login-box">
        <form class="login-form" action="{{ route('admin.reset_password',[$check_token->token]) }}" method="POST">
            @csrf
            <h3 class="login-head"><i class="fa fa-unlock fa-lg fa-fw"></i>تعيين كلمة مرور جديدة</h3>
            <div class="form-group">
                <label class="control-label">البريد الإلكترونى</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $check_token->email }}"  placeholder="mail@example.com" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="control-label">كلمة المرور</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  placeholder="كلمة المرور">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="control-label">تاكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"  placeholder="كلمة المرور">
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group btn-container">
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>تعيين</button>
            </div>
        </form>
        @include('auth.passwords.reset')
    </div>
@endsection
