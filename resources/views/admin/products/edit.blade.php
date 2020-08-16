@extends('layouts.admin.app')
@section('title','تعديل منتج')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-building"></i> المنتجات</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products') }}"><i class="fa fa-building"></i> المنتجات</a></li>
            <li class="breadcrumb-item active">تعديل</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="tile">
                <h3 class="tile-title">تعديل منتج</h3>
                <div class="tile-body">
                    <form action="{{ route('admin.products.update',$product->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="control-label">اسم المنتج</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $product ? $product->name : ''}}" placeholder="فيلا,شقة..." required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="from-group">
                            <button type="button" class="btn btn-warning ml-1" onclick="history.back();"><i class="fa fa-fw -fa-lg fa-arrow-right"></i> تراجع</button>
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>تحديث</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection