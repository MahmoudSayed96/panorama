{{-- @extends('layouts.admin.auth')
@section('title','إعادة تعيين كلمة المرور')
@section('content')
 
@endsection --}}

@component('mail::message')
# Hello, {{ $data['user']->name }}

<p>Click here to reset your password</p>

@component('mail::button', ['url' =>  route('admin.get_reset_password',$data['token'])])
    Reset Password
@endcomponent

<br>

<strong>OR copy this link</strong>
<a href="{{route('admin.get_reset_password',$data['token'])}}">{{route('admin.get_reset_password',$data['token'])}}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
