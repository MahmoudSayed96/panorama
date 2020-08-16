@extends('layouts.admin.app')
@section('title','الصفحة الشخصية')
@section('content')
<div class="tile user-settings">
    @include('admin.includes._messages')
    <h4 class="line-head">الصفحة الشخصية</h4>
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>الاسم</label>
            <input type="text" class="form-control" name="name" value="{{ currentUser()->name }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>البريد الالكترونى</label>
            <input type="email" class="form-control" name="email" value="{{ currentUser()->email }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-6">
                    <label>الصورة الشخصية</label>
                    <input type="file" id="imgInp" class="form-control" name="photo">
                    @error('photo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-6">
                    <img src="{{ currentUser()->photo }}" class="img-fluid img-thumbnail" width="100px" height="100px" id="imgPreview" alt="{{ currentUser()->name }}">
                </div>
            </div>
        </div>
      <div class="row mb-10">
        <div class="from-group">
            <button type="button" class="btn btn-warning ml-1" onclick="history.back();"><i class="fa fa-fw -fa-lg fa-arrow-right"></i> تراجع</button>
            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>تحديث</button>
        </div>
      </div>
    </form>
  </div>
@endsection