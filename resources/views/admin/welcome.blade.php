@extends('layouts.admin.app')
@section('title','لوحة التحكم')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> الرئيسية</h1>
        <p>لوحة التحكم الرئيسية ف الموقع</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item active"><i class="fa fa-dashboard fa-lg"></i> الرئيسية</li>
    </ul>
</div>
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
                <h4>الموظفين</h4>
                <p><b>{{$usersCount}}</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-handshake-o fa-3x"></i>
            <div class="info">
                <h4>العروض</h4>
                <p><b>{{$offersCount}}</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
                <h4>Uploades</h4>
                <p><b>10</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
                <h4>Stars</h4>
                <p><b>500</b></p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    {{ public_path() }}<br>
    {{ asset('uploads') }}<br>
    {{ url('uploads') }}
</div>
@endsection