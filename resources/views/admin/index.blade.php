@extends('layouts.admin')

@section('title', 'Dashboard')

@section('heading', 'Dashboard')

@section('dashboardActive', 'active')

@section('createbtn')
    <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
@endsection

@section('content')
<div class="">
    <h1>Welcome <strong>{{$user->first_name . ' ' . $user->last_name}}</strong></h1>
    <h3>Account ID : <span>{{$user->id}}</span></h3>
</div>
</section>
@endsection
