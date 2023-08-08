@extends('layouts.admin')

@section('title', 'Error')

@section('heading', 'Error occured')

@section('content')
    <div class="container-fluid">
        <div class="text-center">
            <div class="error mx-auto" data-text="{{$errorCode}}">{{$errorCode}}</div>
            <p class="lead text-gray-800 mb-5">
                Please reach out to the administrator with the provided error code for further assistance.</p>
            <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
            <a href="{{route('admin.dashboard')}}">&larr; Back to Dashboard</a>
        </div>
    </div>
@endsection
