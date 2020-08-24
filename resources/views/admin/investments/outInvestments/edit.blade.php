@extends('layouts.admin.app')
@section('title','استثمارات خارجية|الاستثمارات')
@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-money"></i> الاستثمارات</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}"><i class="fa fa-dashboard"></i> الرئيسية</a>
        </li>
        <li class="breadcrumb-item"><a href="{{ route('admin.investments.out_investments') }}"><i
                    class="fa fa-credit-card-alt"></i>
                الاستثمارات</a>
        </li>
        <li class="breadcrumb-item active">تعديل</li>
    </ul>
</div>
<div class="row">
    <div class="col-12">
        <div class="tile">
            <h3 class="tile-title">تعديل | استمارث خارجي</h3>
            <div class="tile-body">
                <form action="{{ route('admin.investments.out_investments.update',$outInvestment) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            {{-- Client Nmae --}}
                            <div class="form-group">
                                <label for="client_name" class="control-label">اسم العميل</label>
                                <input type="text" name="client_name" id="client_name"
                                    value="{{ $outInvestment->client_name }}"
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
                                    value="{{ $outInvestment->client_phone }}"
                                    class="form-control @error('client_phone') is-invalid @enderror" required>
                                @error('client_phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><!-- ./row-->
                    {{-- Income Details --}}
                    <div class="form-group">
                        <label for="editor" class="control-label"> تفاصيل الايراد</label>
                        <textarea name="income_details" id="editor" rows="3"
                            class="form-control @error('income_details') is-invalid @enderror">
                        {{ $outInvestment->income_details }}
                        </textarea>
                        @error('income_details')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            {{-- Paid Amount --}}
                            <div class="form-group">
                                <label for="paid_amount" class="control-label"> المبلغ المدفوع </label>
                                <input type="number" min="0.0" step="0.01" name="paid_amount" id="paid_amount"
                                    value="{{ $outInvestment->paid_amount }}" placeholder="0.00"
                                    class="form-control @error('paid_amount') is-invalid @enderror" required>
                                @error('paid_amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            {{-- Total Amount --}}
                            <div class="form-group">
                                <label for="total_amount" class="control-label">المبلغ الاجمالى</label>
                                <input type="number" min="0.0" step="0.01" name="total_amount" id="total_amount"
                                    placeholder="0.00" value="{{ $outInvestment->total_amount }}"
                                    class="form-control @error('total_amount') is-invalid @enderror" required>
                                @error('total_amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><!-- ./row-->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label>صورة الهوية</label>
                                <input type="file" id="imgInp" class="form-control" name="client_photo" required>
                                @error('client_photo')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <img src="{{ $outInvestment->client_photo }}" class="img-fluid img-thumbnail"
                                    width="100px" height="100px" id="imgPreview" alt="">
                            </div>
                        </div>
                    </div>
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