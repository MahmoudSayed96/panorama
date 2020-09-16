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
        <li class="breadcrumb-item"><a href="{{ route('admin.consulting.clients') }}"><i class="fa fa-wpexplorer"></i>
                استشارات ومقاولات</a>
        </li>
        <li class="breadcrumb-item active">اضافة</li>
    </ul>
</div>
<div class="row">
    <div class="col-12">
        <div class="tile">
            <h3 class="tile-title">اضافة | استشارة هندسية للشركة</h3>
            <div class="tile-body">
                <form action="{{ route('admin.consulting.clients.update',$clientConsulting->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            {{-- Client Nmae --}}
                            <div class="form-group">
                                <label for="client_name" class="control-label">اسم العميل</label>
                                <input type="text" name="client_name" id="client_name"
                                    value="{{ $clientConsulting->client_name }}"
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
                                    value="{{ $clientConsulting->client_phone }}"
                                    class="form-control @error('client_phone') is-invalid @enderror" required>
                                @error('client_phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><!-- ./row-->
                    <div class="row">
                        <div class="col-12 col-md-6">
                            {{-- Project Name --}}
                            <div class="form-group">
                                <label for="project_name" class="control-label">اسم المشروع</label>
                                <input type="text" name="project_name" id="project_name"
                                    value="{{ $clientConsulting->project_name }}"
                                    class="form-control @error('project_name') is-invalid @enderror" required>
                                @error('project_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            {{-- Project Number --}}
                            <div class="form-group">
                                <label for="project_number" class="control-label">رقم المشروع</label>
                                <input type="text" name="project_number" id="project_number"
                                    value="{{ $clientConsulting->project_number }}"
                                    class="form-control @error('project_number') is-invalid @enderror" required>
                                @error('project_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><!-- ./row-->
                    <div class="row">
                        <div class="col-12 col-md-6">
                            {{-- Piece Number --}}
                            <div class="form-group">
                                <label for="piece_number" class="control-label">رقم القطعة</label>
                                <input type="text" name="piece_number" id="piece_number"
                                    value="{{ $clientConsulting->piece_number }}"
                                    class="form-control @error('piece_number') is-invalid @enderror" required>
                                @error('piece_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            {{-- Suk Number --}}
                            <div class="form-group">
                                <label for="suk_number" class="control-label">رقم الصك</label>
                                <input type="text" name="suk_number" id="suk_number"
                                    value="{{ $clientConsulting->suk_number }}"
                                    class="form-control @error('suk_number') is-invalid @enderror" required>
                                @error('suk_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><!-- ./row-->
                    {{-- Details --}}
                    <div class="form-group">
                        <label for="details">تفاصيل الطلب والتعديل</label>
                        <textarea type="text" name="details" id="editor"
                            class="form-control @error('details') is-invalid @enderror">{!! $clientConsulting->details !!}</textarea>
                        @error('details')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Photos --}}
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="photos">صور الكروكى</label>
                                <input type="file" name="photos[]" class="form-control" id="photos-gallary" multiple>
                                @if ($errors->has('photos.*'))
                                <div class="text-danger">{{ $errors->first('photos.*') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="images-container">
                                @foreach ($clientConsulting->photos as $img)
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
                                class="fa fa-fw fa-lg fa-check-circle"></i>حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection