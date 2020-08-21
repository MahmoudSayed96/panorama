@extends('layouts.admin.app')
@section('title',' عملاء الاقساط|الاستثمارات')
@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-money"></i> الاستثمارات</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}"><i class="fa fa-dashboard"></i> الرئيسية</a>
        </li>
        <li class="breadcrumb-item"><a href="{{ route('admin.investments.premiums') }}"><i
                    class="fa fa-credit-card-alt"></i>
                الاستثمارات</a>
        </li>
        <li class="breadcrumb-item active">تعديل</li>
    </ul>
</div>
<div class="row">
    <div class="col-12">
        <div class="tile">
            <h3 class="tile-title">تعديل | عميل قسط / تمويل </h3>
            <div class="tile-body">
                <form action="{{ route('admin.investments.premiums.update',$premium->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            {{-- Client Nmae --}}
                            <div class="form-group">
                                <label for="client_name" class="control-label">اسم العميل</label>
                                <input type="text" name="client_name" id="client_name"
                                    value="{{ $premium->client_name }}"
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
                                    value="{{ $premium->client_phone }}"
                                    class="form-control @error('client_phone') is-invalid @enderror" required>
                                @error('client_phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><!-- ./row-->
                    {{-- Details --}}
                    <div class="form-group">
                        <label for="editor" class="control-label"> تفاصيل القسط</label>
                        <textarea name="details" id="editor" rows="5"
                            class="form-control @error('details') is-invalid @enderror">
                        {{ old('details') }}
                        </textarea>
                        @error('details')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            {{-- Alqist Amount --}}
                            <div class="form-group">
                                <label for="alqist_amount" class="control-label">مبلغ القسط </label>
                                <input type="number" min="0.0" step="0.01" name="alqist_amount" id="alqist_amount"
                                    value="{{ $premium->alqist_amount }}" placeholder="0.00"
                                    class="form-control @error('alqist_amount') is-invalid @enderror" required>
                                @error('alqist_amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            {{-- Remaining Amount --}}
                            <div class="form-group">
                                <label for="remaining_amount" class="control-label">اجمالى المبلغ المتبقى</label>
                                <input type="number" min="0.0" step="0.01" name="remaining_amount" id="remaining_amount"
                                    placeholder="0.00" value="{{ $premium->remaining_amount }}"
                                    class="form-control @error('remaining_amount') is-invalid @enderror" required>
                                @error('remaining_amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            {{-- End Date --}}
                            <div class="form-group">
                                <label for="end_amount_date" class="control-label">تاريخ انتهاء القسط</label>
                                <input type="text" name="end_amount_date" id="end_amount_date"
                                    value="{{ $premium->end_amount_date }}"
                                    class="form-control @error('end_amount_date') is-invalid @enderror selectDate"
                                    required>
                                @error('end_amount_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><!-- ./row-->
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