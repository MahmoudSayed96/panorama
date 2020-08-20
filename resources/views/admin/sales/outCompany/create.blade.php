@extends('layouts.admin.app')
@section('title','اضافة جديدة|المبيعات')
@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-diamond"></i> المبيعات</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}"><i class="fa fa-dashboard"></i> الرئيسية</a>
        </li>
        <li class="breadcrumb-item"><a href="{{ route('admin.sales.out_company') }}"><i class="fa fa-life-ring"></i>
                المبيعات</a>
        </li>
        <li class="breadcrumb-item active">اضافة</li>
    </ul>
</div>
<div class="row">
    <div class="col-12">
        <div class="tile">
            <h3 class="tile-title">اضافة | المبيعات خارج الشركة </h3>
            <div class="tile-body">
                <form action="{{ route('admin.sales.out_company.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>نوع المنتج</label>
                        <select class="form-control select2 @error('product') is-invalid @enderror" name="product"
                            tabindex="-1" aria-hidden="true" required>
                            <optgroup label="اختر نوع المنتج">
                                @foreach ($products as $product)
                                <option value="{{$product->id}}" {{ $product->id == old('product') ? 'selected':''}}>
                                    {{ $product->name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        @error('product')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            {{-- Buyer Nmae --}}
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">اسم المشترى</label>
                                <input type="text" name="buyer_name" id="buyer_name" value="{{ old('buyer_name') }}"
                                    class="form-control @error('buyer_name') is-invalid @enderror" required>
                                @error('buyer_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="col-12 col-md-6">
                            {{-- Buyer Phone--}}
                            <div class="form-group">
                                <label for="buyer_phone" class="control-label">رقم المشترى</label>
                                <input type="number" name="buyer_phone" id="buyer_phone"
                                    value="{{ old('buyer_phone') }}"
                                    class="form-control @error('buyer_phone') is-invalid @enderror" required>
                                @error('buyer_phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><!-- ./row-->
                    <div class="row">
                        <div class="col-12 col-md-6">
                            {{-- Price --}}
                            <div class="form-group">
                                <label for="price" class="control-label">السعر</label>
                                <input type="number" min="0.0" step="0.01" name="price" id="price" placeholder="0.00"
                                    value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror"
                                    required>
                                @error('price')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            {{-- Wasit --}}
                            <div class="form-group">
                                <label class="control-label">هل يوجد وسيط؟</label>
                                <div class="animated-radio-button">
                                    <label for="yes">
                                        <input type="radio" name="wasit" id="yes" value="1"><span
                                            class="label-text">نعم</span>
                                    </label>
                                    <label for="no" class="mr-5">
                                        <input type="radio" name="wasit" id="no" value="0" checked><span
                                            class="label-text">لا</span>
                                    </label>
                                </div>
                                @error('wasit')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><!-- ./row-->
                    {{-- Wasit --}}
                    <div class="form-group">
                        <label for="indication" class="control-label">الدلالة</label>
                        <textarea name="indication" id="indication"
                            class="form-control @error('indication') is-invalid @enderror"
                            required>{{ old('indication') }}</textarea>
                        @error('indication')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="from-group">
                        <button type="button" class="btn btn-warning ml-1" onclick="history.back();"><i
                                class="fa fa-fw -fa-lg fa-arrow-right"></i> تراجع</button>
                        <button class="btn btn-primary" type="submit"><i
                                class="fa fa-fw fa-lg fa-check-circle"></i>حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection