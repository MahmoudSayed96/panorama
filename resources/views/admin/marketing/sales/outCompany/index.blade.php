@extends('layouts.admin.app')
@section('title','المبيعات |التسويق')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-handshake-o"></i> التسويق</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}"><i
                    class="fa fa-dashboard fa-lg"></i>الرئيسية</a></li>
        <li class="breadcrumb-item active">المبيعات</li>
    </ul>
</div>
<div class="row">
    <div class="col-12">
        @include('admin.includes._messages')
        <div class="tile">
            <h2 class="tile-title">المبيعات خارج الشركة</h2>
            @if (currentUser()->hasPermission('create_marketing'))
            <div class="tile-title">
                <a href="{{ route('admin.marketing.sales.out_company.create') }}" class="btn btn-success">اضاف جديد <i
                        class="fa fa-plus fa-fw fa-lg" aria-hidden="true"></i></a>
            </div>
            @endif
            <div class="tile-body">
                @if (isset($outCompanySales) && count($outCompanySales) > 0)
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
                                                aria-label="التاريخ: activate to sort column descending">التاريخ</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="اسم المشترى: activate to sort column descending">اسم
                                                المشترى</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="رقم المشترى: activate to sort column descending">رقم
                                                المشترى</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="المنتج: activate to sort column descending">المنتج</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="يوجد وسيط: activate to sort column descending">يوجد وسيط
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="السعر: activate to sort column descending">السعر</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="الدلالة: activate to sort column descending">الدلالة</th>
                                            <th>التحكم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($outCompanySales as $index=>$outCompany)
                                        <tr role="row" class="{{ $index % 2 == 0 ? 'even' : 'odd' }}">
                                            <td class="sorting_1">
                                                {{ $outCompany->created_at->toDateString() }}</td>
                                            <td class="sorting_1">{{ $outCompany->buyer_name }}</td>
                                            <td class="sorting_1">{{ $outCompany->buyer_phone }}</td>
                                            <td class="sorting_1">{{ $outCompany->product->name }}</td>
                                            <td class="sorting_1">{{ $outCompany->getWasit() }}</td>
                                            <td class="sorting_1">{{ formatNumber($outCompany->price) }}</td>
                                            <td class="sorting_1">{{ $outCompany->indication }}</td>
                                            <td>
                                                @if (currentUser()->hasPermission('update_marketing'))
                                                <a href="{{ route('admin.marketing.sales.out_company.edit',$outCompany->id) }}"
                                                    class="btn btn-warning btn-sm ml-3"><i
                                                        class="fa fa-pencil-square fa-lg"></i> تعديل</a>
                                                @endif
                                                @if (currentUser()->hasPermission('delete_marketing'))
                                                <form
                                                    action="{{ route('admin.marketing.sales.out_company.delete',$outCompany->id) }}"
                                                    method="POST" style="display:inline-block" class="ml-3">
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