@extends('layouts.admin.app')
@section('title','اضافة عرض')
@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-handshake-o"></i> العروض</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}"><i class="fa fa-dashboard"></i> الرئيسية</a>
        </li>
        <li class="breadcrumb-item"><a href="{{ route('admin.offers') }}"><i class="fa fa-handshake-o"></i> العروض</a>
        </li>
        <li class="breadcrumb-item active">اضافة</li>
    </ul>
</div>
<div class="row">
    <div class="col-12">
        <div class="tile">
            <h3 class="tile-title">اضافة عرض</h3>
            <div class="tile-body">
                <form action="{{ route('admin.offers.store') }}" method="post" enctype="multipart/form-data">
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
                            {{-- Product Owner --}}
                            <div class="form-group">
                                <label for="prod_owner" class="control-label">اسم صاحب المنتج</label>
                                <input type="text" name="prod_owner" id="prod_owner" value="{{ old('prod_owner') }}"
                                    class="form-control @error('prod_owner') is-invalid @enderror" required>
                                @error('prod_owner')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="col-12 col-md-6">
                            {{-- Product Owner Phone--}}
                            <div class="form-group">
                                <label for="prod_owner_phone" class="control-label">رقم صاحب المنتج</label>
                                <input type="text" name="prod_owner_phone" id="prod_owner_phone"
                                    value="{{ old('prod_owner_phone') }}"
                                    class="form-control @error('prod_owner_phone') is-invalid @enderror" required>
                                @error('prod_owner_phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><!-- ./row-->
                    <div class="row">
                        <div class="col-12 col-md-6">
                            {{-- Product Area --}}
                            <div class="form-group">
                                <label for="prod_area" class="control-label">المساحة</label>
                                <input type="number" min="0.0" step="0.01" name="prod_area" id="prod_area"
                                    placeholder="0.00" value="{{ old('prod_area') }}"
                                    class="form-control @error('prod_area') is-invalid @enderror" required>
                                @error('prod_area')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="col-12 col-md-6">
                            {{-- Product Owner Phone--}}
                            <div class="form-group">
                                <label for="prod_price" class="control-label">السعر</label>
                                <input type="number" name="prod_price" min="0.0" step="0.01"
                                    value="{{ old('prod_price') }}" id="prod_price" placeholder="0.00"
                                    class="form-control @error('prod_price') is-invalid @enderror" required>
                                @error('prod_price')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><!-- ./row-->
                    {{-- Product Images --}}
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="photos">صور المنتج</label>
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