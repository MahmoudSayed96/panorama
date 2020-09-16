@extends('layouts.admin.app')
@section('title','استشارات ومقاولات')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-wpexplorer"></i> استشارات ومقاولات</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}"><i
                    class="fa fa-dashboard fa-lg"></i>الرئيسية</a></li>
        <li class="breadcrumb-item active">استشارات ومقاولات</li>
    </ul>
</div>
<div class="row">
    <div class="col-12">
        @include('admin.includes._messages')
        <div class="tile">
            <h2 class="tile-title">استشارات هندسية خارج الشركة</h2>
            @if (currentUser()->hasPermission('create_decorations'))
            <div class="tile-title">
                <a href="{{ route('admin.consulting.company.create') }}" class="btn btn-success">اضاف جديد <i
                        class="fa fa-plus fa-fw fa-lg" aria-hidden="true"></i></a>
            </div>
            @endif
            <div class="tile-body">
                @if (isset($clientConsulting) && count($clientConsulting) > 0)
                <div class="table-responsive">
                    <div id="dt_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-hover table-bordered dataTable no-footer text-center" id="dt"
                                    role="grid" aria-describedby="sampleTable_info">
                                    <thead>
                                        <tr role="row">
                                            <th style="width:80px;" class="sorting_asc" tabindex="0" aria-controls="dt"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="التاريخ: activate to sort column descending">التاريخ</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="اسم العميل: activate to sort column descending">اسم العميل
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="رقم الهاتف: activate to sort column descending">رقم الهاتف
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="اسم المشروع: activate to sort column descending">اسم المشروع
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="رقم المشروع: activate to sort column descending">رقم المشروع
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="رقم القطعة: activate to sort column descending">رقم القطعة
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dt" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="رقم الصك: activate to sort column descending">رقم الصك
                                            </th>
                                            <th style="width: 250px;">التحكم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clientConsulting as $index=>$client)
                                        <tr role="row" class="{{ $index % 2 == 0 ? 'even' : 'odd' }}">
                                            <td class="sorting_1">
                                                {{ $client->created_at->toDateString() }}</td>
                                            <td class="sorting_1">{{ $client->client_name }}</td>
                                            <td class="sorting_1">{{ $client->client_phone }}</td>
                                            <td class="sorting_1">{{ $client->project_name }}</td>
                                            <td class="sorting_1">{{ $client->project_number }}</td>
                                            <td class="sorting_1">{{ $client->piece_number }}</td>
                                            <td class="sorting_1">{{ $client->suk_number }}</td>
                                            <td>
                                                @if (currentUser()->hasPermission('read_consulting'))
                                                <a href="{{ route('admin.consulting.company.show',$client->id) }}"
                                                    class="btn btn-info btn-sm ml-3"><i class="fa fa-eye fa-lg"></i>
                                                    عرض</a>
                                                @endif
                                                @if (currentUser()->hasPermission('update_consulting'))
                                                <a href="{{ route('admin.consulting.company.edit',$client->id) }}"
                                                    class="btn btn-warning btn-sm ml-3"><i
                                                        class="fa fa-pencil-square fa-lg"></i> تعديل</a>
                                                @endif
                                                @if (currentUser()->hasPermission('delete_consulting'))
                                                <form
                                                    action="{{ route('admin.consulting.company.delete',$client->id) }}"
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