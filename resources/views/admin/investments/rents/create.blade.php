@extends('layouts.admin.app')
@section('title',' ايجار برنامج|الاستثمارات')
@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-money"></i> الاستثمارات</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}"><i class="fa fa-dashboard"></i> الرئيسية</a>
        </li>
        <li class="breadcrumb-item"><a href="{{ route('admin.investments.rents') }}"><i class="fa fa-lightbulb-o"></i>
                الاستثمارات</a>
        </li>
        <li class="breadcrumb-item active">اضافة</li>
    </ul>
</div>
<div class="row">
    <div class="col-12">
        <div class="tile">
            <h3 class="tile-title">اضافة | ايجار برنامج </h3>
            <div class="tile-body">
                <form action="{{ route('admin.investments.rents.store') }}" method="post">
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
                    <div class="row">
                        <div class="col-12 col-md-6">
                            {{-- Contract --}}
                            <div class="form-group">
                                <label for="contract_type" class="control-label"> نوع العقد</label>
                                <input type="text" name="contract_type" id="contract_type"
                                    value="{{ old('contract_type') }}"
                                    class="form-control @error('contract_type') is-invalid @enderror" required>
                                @error('contract_type')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
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