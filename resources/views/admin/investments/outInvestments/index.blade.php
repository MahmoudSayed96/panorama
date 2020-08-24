@extends('layouts.admin.app')
@section('title','الاستثمارات')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-money"></i> الاستثمارات</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}"><i
                    class="fa fa-dashboard fa-lg"></i>الرئيسية</a></li>
        <li class="breadcrumb-item active">الاستثمارات</li>
    </ul>
</div>
<div class="row">
    <div class="col-12">
        @include('admin.includes._messages')
        <div class="tile">
            <h2 class="tile-title">الاستثمارات الخارجية</h2>
            @if (currentUser()->hasPermission('create_investments'))
            <div class="tile-title">
                <a href="{{ route('admin.investments.out_investments.create') }}" class="btn btn-success">اضاف جديد <i
                        class="fa fa-plus fa-fw fa-lg" aria-hidden="true"></i></a>
            </div>
            @endif
            <div class="tile-body">
                @if (isset($outInvestments) && count($outInvestments) > 0)
                <div class="table-responsive">
                    <div id="dt_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-hover table-bordered dataTable no-footer text-center" id="dt"
                                    role="grid" aria-describedby="sampleTable_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="التاريخ: activate to sort column descending"
                                                style="width:60px;">
                                                التاريخ</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="اسم العميل: activate to sort column descending">اسم
                                                العميل</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="صورة الهوية: activate to sort column descending">صورة الهوية
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="رقم العميل: activate to sort column descending">رقم
                                                العميل</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="تفاصيل الايراد: activate to sort column descending">تفاصيل
                                                الايراد</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="المبلغ المدفوع: activate to sort column descending">المبلغ
                                                المدفوع
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="المبلغ الاجمالى: activate to sort column descending">
                                                المبلغ الاجمالى
                                            </th>
                                            <th style="width:150px">التحكم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($outInvestments as $index=>$outInvestment)
                                        <tr role="row" class="{{ $index % 2 == 0 ? 'even' : 'odd' }}">
                                            <td class="sorting_1">
                                                {{ $outInvestment->created_at->toDateString() }}</td>
                                            <td class="sorting_1">{{ $outInvestment->client_name }}</td>
                                            <td class="sorting_1">
                                                <img src="{{ $outInvestment->client_photo }}"
                                                    alt="{{ $outInvestment->client_name }}" width="200px"
                                                    height="100px">
                                            </td>
                                            <td class="sorting_1">{{ $outInvestment->client_phone }}</td>
                                            <td class="sorting_1">{!! $outInvestment->income_details !!}</td>
                                            <td class="sorting_1">{{ formatNumber($outInvestment->paid_amount) }}</td>
                                            <td class="sorting_1">{{ formatNumber($outInvestment->total_amount) }}
                                            </td>
                                            <td>
                                                @if (currentUser()->hasPermission('update_investments'))
                                                <a href="{{ route('admin.investments.out_investments.edit',$outInvestment->id) }}"
                                                    class="btn btn-warning btn-sm"><i
                                                        class="fa fa-pencil-square fa-lg"></i> تعديل</a>
                                                @endif
                                                @if (currentUser()->hasPermission('delete_investments'))
                                                <form
                                                    action="{{ route('admin.investments.out_investments.delete',$outInvestment->id) }}"
                                                    method="POST" style="display:inline-block">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm delete"><i
                                                            class="fa fa-trash-o fa-lg"></i>
                                                        حذف</button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <h2 class="text-center">لا يوجد سجلات</h2>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection