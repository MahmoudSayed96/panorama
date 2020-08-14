{{-- @extends('layouts.admin.auth')
@section('title','تعيين كلمة مرور جديدة')
@section('content')

@endsection --}}
<form class="forget-form" action="{{ route('admin.forgot_password') }}" method="POST">
    @csrf
    <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>إعادة تعيين كلمة المرور</h3>
    <div class="form-group">
        <label class="control-label">البريد الألكترونى</label>
        <input name="email" class="form-control @error('email') is-invalid @enderror" type="email" placeholder="mail@example.com">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group btn-container">
        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>تعيين</button>
    </div>
    <div class="form-group mt-3">
        <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i>الرجوع لتسجيل الدخول</a></p>
    </div>
</form>
