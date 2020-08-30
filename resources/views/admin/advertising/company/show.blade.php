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
        <li class="breadcrumb-item active">عرض</li>
    </ul>
</div>
<div class="row">
    <div class="col-12">
        <div class="tile">
            <div class="tile-body">
                @if ($cmpDesign)
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h3 class="text-center mb-3">التفاصيل</h3>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong> <i class="fa fa-user fa-lg text-primary ml-3"></i> اسم العميل :
                                </strong> {{ $cmpDesign->client_name }}
                            </li>
                            <li class="list-group-item">
                                <strong> <i class="fa fa-phone fa-lg text-primary ml-3"></i>رقم هاتف العميل :
                                </strong> {{ $cmpDesign->client_phone }}
                            </li>
                            <li class="list-group-item">
                                <strong> <i class="fa fa-money fa-lg text-primary ml-3"></i> المبلغ المدفوع :
                                </strong> {{ formatNumber($cmpDesign->paid_amount) }}
                            </li>
                            <li class="list-group-item">
                                <strong> <i class="fa fa-calendar fa-lg text-primary ml-3"></i> تاريخ التسليم :
                                </strong> {{ $cmpDesign->delivered_date }}
                            </li>
                        </ul>
                    </div>
                    @if ($cmpDesign->photos)
                    <div class="col-12 col-md-6">
                        <h3 class="text-center mb-3 mt-3 mt-md-0">صور التصميم</h3>
                        <div class="show-img mx-auto">
                            <img src="{{ asset($cmpDesign->photos[0]) }}" class="img-fluid img-thumbnail" width="100%"
                                height="300px">
                        </div>
                        <div class="gallery mt-3">
                            @foreach ($cmpDesign->photos as $img)
                            <img src="{{ asset($img) }}" class="img-fluid m-2" width="100px" height="100px">
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endif
                <button type="button" class="btn btn-warning ml-1 mt-4" onclick="history.back();"><i
                        class="fa fa-fw -fa-lg fa-arrow-right"></i> تراجع</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
<style>
    .show-img img {
        max-height: 300px;
    }

    .gallery img:hover {
        cursor: pointer;
        opacity: .8;
    }
</style>
@endpush
@push('scripts')
<script>
    $(document).ready(function(){
            $('.gallery img').on('click',function(){
                var src = $(this).attr('src');
                $(this).addClass('img-thumbnail').siblings().removeClass('img-thumbnail');
                $('.show-img img').attr('src',src);
            });
        });
</script>
@endpush