@extends('layouts.admin.app')
@section('title','استشارات ومقاولات')
@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-wpexplorer"></i> استشارات ومقاولات</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}"><i class="fa fa-dashboard"></i> الرئيسية</a>
        </li>
        <li class="breadcrumb-item"><a href="{{ route('admin.constructions.clients') }}"><i
                    class="fa fa-wpexplorer"></i>
                استشارات ومقاولات</a>
        </li>
        <li class="breadcrumb-item active">اضافة</li>
    </ul>
</div>
<div class="row">
    <div class="col-12">
        <div class="tile">
            <h3 class="tile-title">اضافة | مقاولات خارج الشركة</h3>
            <div class="tile-body">
                <form action="{{ route('admin.constructions.clients.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            {{-- Client Nmae --}}
                            <div class="form-group">
                                <label for="client_name" class="control-label">اسم العميل</label>
                                <input type="text" name="client_name" id="client_name" value="{{ old('client_name') }}"
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
                                    value="{{ old('client_phone') }}"
                                    class="form-control @error('client_phone') is-invalid @enderror" required>
                                @error('client_phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><!-- ./row-->
                    {{-- Project Address --}}
                    <div class="form-group">
                        <label for="project_address" class="control-label">موقع المشروع</label>
                        <input type="text" name="project_address" id="project_address"
                            value="{{ old('project_address') }}"
                            class="form-control @error('project_address') is-invalid @enderror" required>
                        @error('project_address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            {{-- Paid Amount --}}
                            <div class="form-group">
                                <label for="paid_amount" class="control-label"> المبلغ المدفوع</label>
                                <input type="text" name="paid_amount" id="paid_amount" min="0.0" step="0.01"
                                    value="{{ old('paid_amount') }}" placeholder="0.00"
                                    class="form-control @error('paid_amount') is-invalid @enderror" required>
                                @error('paid_amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            {{-- Reaming Amount --}}
                            <div class="form-group">
                                <label for="reaming_amount" class="control-label">رقم الصك</label>
                                <input type="text" name="reaming_amount" id="reaming_amount" min="0.0" step="0.01"
                                    value="{{ old('reaming_amount') }}" placeholder="0.00"
                                    class="form-control @error('reaming_amount') is-invalid @enderror" required>
                                @error('reaming_amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><!-- ./row-->
                    {{-- Project Details --}}
                    <div class="form-group">
                        <label for="project_details">تفاصيل المشروع</label>
                        <textarea type="text" name="project_details" id="editor"
                            class="form-control @error('project_details') is-invalid @enderror">{{ old('project_details') }}</textarea>
                        @error('project_details')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Photos --}}
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="photos">صور العقد</label>
                                <input type="file" name="photos[]" class="form-control" id="photos-gallary" multiple>
                                @if ($errors->has('photos.*'))
                                <div class="text-danger">{{ $errors->first('photos.*') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="images-container">
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