@extends('layouts.admin.app')
@section('title','الصفحة الشخصية')
@section('content')
<div class="tile user-settings">
    @include('admin.includes._messages')
    <h4 class="line-head">الصفحة الشخصية</h4>
    <hr>
    <div class="profile">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="user-img">
                    <img src="{{ currentUser()->photo }}" class="img-fluid img-thumbnail p-2 circle" width="250px"
                        alt="{{ currentUser()->name }}">
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="info border-right">
                    <div class="name d-flex align-items-center">
                        <h4><i class="fa fa-user" aria-hidden="true"></i> الاسم : </h4>
                        <h6 class="mt-2 mr-2">{{ currentUser()->name }}</h6>
                    </div>
                    <div class="name d-flex align-items-center">
                        <h4><i class="fa fa-envelope" aria-hidden="true"></i> البريد الالكترونى : </h4>
                        <h6 class="mt-2 mr-2">{{ currentUser()->email }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row mb-10 mt-5">
        <div class="from-group">
            <button type="button" class="btn btn-warning ml-1" onclick="history.back();"><i
                    class="fa fa-fw -fa-lg fa-arrow-right"></i> تراجع</button>
            <a class="btn btn-primary" href="{{ route('admin.profile.edit') }}"><i
                    class="fa fa-fw fa-lg fa-check-circle"></i>تحديث</a>
        </div>
    </div>
</div>
@endsection