@extends('layouts.admin.app')
@section('title','الديكور والاعلان')
@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-codepen"></i>الديكور والاعلان</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}"><i class="fa fa-dashboard"></i> الرئيسية</a>
        </li>
        <li class="breadcrumb-item"><a href="{{ route('admin.advertising.company') }}"><i class="fa fa-codepen"></i>
                الديكور والاعلان</a>
        </li>
        <li class="breadcrumb-item active">تعديل</li>
    </ul>
</div>
<div class="row">
    <div class="col-12">
        <div class="tile">
            <h3 class="tile-title">تعديل | اعلان للشركة</h3>
            <div class="tile-body">
                <form action="{{ route('admin.advertising.company.update',$cmpDesign->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            {{-- Client Nmae --}}
                            <div class="form-group">
                                <label for="client_name" class="control-label">اسم العميل</label>
                                <input type="text" name="client_name" id="client_name"
                                    value="{{ $cmpDesign->client_name }}"
                                    class="form-control @error('client_name') is-invalid @enderror" required>
                                @error('client_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="col-12 col-md-6">
                            {{-- Client Phone--}}
                            <div class="form-group">
                                <label for="client_phone" class="control-label">رقم هاتف العميل</label>
                                <input type="number" name="client_phone" id="client_phone"
                                    value="{{ $cmpDesign->client_phone }}"
                                    class="form-control @error('client_phone') is-invalid @enderror" required>
                                @error('client_phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><!-- ./row-->
                    <div class="row">
                        <div class="col-12 col-md-6">
                            {{-- Paid amount --}}
                            <div class="form-group">
                                <label for="paid_amount" class="control-label">المبلغ المدفوع</label>
                                <input type="number" min="0.0" step="0.01" name="paid_amount" id="paid_amount"
                                    placeholder="0.00" value="{{ $cmpDesign->paid_amount }}"
                                    class="form-control @error('paid_amount') is-invalid @enderror" required>
                                @error('paid_amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            {{-- Delivered Date --}}
                            <div class="form-group">
                                <label for="delivered_date" class="control-label">تاريخ الاستلام</label>
                                <input type="text" name="delivered_date" id="delivered_date"
                                    value="{{ $cmpDesign->delivered_date }}"
                                    class="form-control @error('delivered_date') is-invalid @enderror selectDate"
                                    required>
                                @error('delivered_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><!-- ./row-->
                    {{-- Photos --}}
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="photos">صور التصميم</label>
                                <input type="file" name="photos[]" class="form-control" id="photos-gallary" multiple>
                                @if ($errors->has('photos.*'))
                                <div class="text-danger">{{ $errors->first('photos.*') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="images-container">
                                @foreach ($cmpDesign->photos as $img)
                                <img src="{{ asset($img) }}" class="img-fluid m-2 img-thumbnail" width="100px"
                                    height="100px">
                                @endforeach
                            </div>
                        </div>
                    </div><!-- ./row-->
                    <div class="from-group">
                        <button type="button" class="btn btn-warning ml-1" onclick="history.back();"><i
                                class="fa fa-fw -fa-lg fa-arrow-right"></i> تراجع</button>
                        <button class="btn btn-primary" type="submit"><i
                                class="fa fa-fw fa-lg fa-check-circle"></i>تحديث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection