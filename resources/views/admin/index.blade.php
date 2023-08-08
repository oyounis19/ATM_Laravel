@extends('layouts.admin')

@section('title', 'Dashboard')

@section('heading', 'Dashboard')

@section('dashboardActive', 'active')

@section('createbtn')
    <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
@endsection

@section('content')
<div class="">
    <h1>Welcome <span>{{$user->name}}</span></h1>
    <h3>Account ID : <span>2196</span></h3>
</div>
</section>
@endsection
