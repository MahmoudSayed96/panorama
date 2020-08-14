@extends('layouts.admin.auth')

@section('content')
    <div class="page-error tile">
        <h1><i class="fa fa-exclamation-circle"></i> خطأ 404: هذة الصفحة لاتوجد</h1>
        <p><a class="btn btn-primary" href="javascript:window.history.back();">رجوع</a></p>
    </div>
@endsection