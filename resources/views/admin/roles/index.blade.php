@extends('layouts.admin.app')
@section('title','الصلاحيات')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-lock"></i> الصلاحيات</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}"><i
                    class="fa fa-dashboard fa-lg"></i>الرئيسية</a></li>
        <li class="breadcrumb-item active">الصلاحيات</li>
    </ul>
</div>
<div class="row">
    <div class="col-12">
        @include('admin.includes._messages')
        <div class="tile">
            <div class="tile-body">
                @if (isset($roles) && count($roles) > 0)
                <div class="table-responsive">
                    <div id="dt_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-hover table-bordered dataTable no-footer" id="dt" role="grid"
                                    aria-describedby="sampleTable_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="الصلاحية: activate to sort column descending"
                                                style="width: 154px;">الصلاحية</th>
                                            <th style="width: 254px;">التحكم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $index=>$role)
                                        <tr role="row" class="{{ $index % 2 == 0 ? 'even' : 'odd'}}">
                                            <td class="sorting_1">{{ $role->display_name }}</td>
                                            <td>
                                                @if (currentUser()->hasPermission('update_roles'))
                                                <a href="{{ route('admin.roles.edit',$role->id) }}"
                                                    class="btn btn-warning btn-sm"><i
                                                        class="fa fa-pencil-square fa-lg"></i> تعديل</a>
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