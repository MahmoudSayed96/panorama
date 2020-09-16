@extends('layouts.admin.app')
@section('title','تعديل صلاحية')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-lock"></i> الصلاحيات</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}"><i class="fa fa-dashboard"></i> الرئيسية</a>
        </li>
        <li class="breadcrumb-item"><a href="{{ route('admin.roles') }}"><i class="fa fa-lock"></i> الصلاحيات</a></li>
        <li class="breadcrumb-item active">تعديل</a></li>
    </ul>
</div>
<div class="row">
    <div class="col-12">
        <div class="tile">
            <div class="tile-body">
                <form action="{{ route('admin.roles.update',$role->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label">اسم الصلاحية</label>
                        <input type="text" name="name" id="name" value="{{ $role->name }}" class="form-control"
                            readonly>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="display_name" class="control-label">الاسم المعروض</label>
                        <input type="text" name="display_name" id="display_name" value="{{ $role->display_name }}"
                            class="form-control">
                        @error('display')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">الوصف</label>
                        <input type="text" name="description" id="description" value="{{ $role->description }}"
                            class="form-control">
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Permissions table fro role --}}
                    <div class="form-group">
                        <div class="tile">
                            <h3 class="tile-title">الاذونات/الصلاحيات</h3>
                            @php
                            $permissions=['read_','create_','update_','delete_'];
                            $modules=['users','products','marketing','investments','decorations','consulting','roles'];
                            $map = [
                            'users' =>'الموظفين',
                            'products'=>'المنتجات',
                            'marketing'=>'التسويق',
                            'investments'=>'الاستثمار',
                            'decorations'=>'الديكوروالاعلان',
                            'consulting'=>'الاستشارات والمقاولات',
                            'roles'=>'الصلاحيات',
                            ];
                            @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>القسم</th>
                                            <th>عرض</th>
                                            <th>اضافة</th>
                                            <th>تعديل</th>
                                            <th>حذف</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($modules as $module)
                                        <tr>
                                            <td>{{ $map[$module] }}</td>
                                            @foreach ($permissions as $permission)
                                            <td>
                                                <div class="animated-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permissions[]"
                                                            value="{{$permission . $module}}"
                                                            {{ in_array($permission . $module,$permission_role) ? 'checked' : '' }}><span
                                                            class="label-text"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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