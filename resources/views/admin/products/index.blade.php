@extends('layouts.admin.app')
@section('title','المنتجات')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-building"></i> المنتجات</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}"><i
                    class="fa fa-dashboard fa-lg"></i>الرئيسية</a></li>
        <li class="breadcrumb-item active">المنتجات</li>
    </ul>
</div>
<div class="row">
    <div class="col-12">
        @include('admin.includes._messages')
        <div class="tile">
            @if (currentUser()->hasPermission('create_products'))
            <div class="tile-title">
                <a href="{{ route('admin.products.create') }}" class="btn btn-success">اضاف جديد <i
                        class="fa fa-plus fa-fw fa-lg" aria-hidden="true"></i></a>
            </div>
            @endif
            <div class="tile-body">
                @if (isset($products) && count($products) > 0)
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
                                                aria-label="الاسم: activate to sort column descending"
                                                style="width: 154px;">الاسم</th>
                                            <th style="width: 254px;">التحكم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $product->name }}</td>
                                            <td>
                                                @if (currentUser()->hasPermission('update_products'))
                                                <a href="{{ route('admin.products.edit',$product->id) }}"
                                                    class="btn btn-warning btn-sm ml-3"><i
                                                        class="fa fa-pencil-square fa-lg"></i> تعديل</a>
                                                @endif
                                                @if (currentUser()->hasPermission('delete_products'))
                                                <form action="{{ route('admin.products.delete',$product->id) }}"
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