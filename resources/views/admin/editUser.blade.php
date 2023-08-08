@extends('layouts.admin')

@section('title', 'Edit User')

@section('heading', 'Edit User')

@section('mngusrbtn', 'active')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container-fluid">
        <form method="post" action="{{route('users.update', $curuser->ssn)}}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$curuser->name}}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>
                <div class="col-md-6">
                    <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{$curuser->street}}" required autocomplete="street" autofocus>
                    @error('street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="area" class="col-md-4 col-form-label text-md-right">{{ __('Area') }}</label>
                <div class="col-md-6">
                    <input id="area" type="text" class="form-control @error('area') is-invalid @enderror" name="area" value="{{$curuser->area}}" required autocomplete="area" autofocus>
                    @error('area')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                <div class="col-md-6">
                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{$curuser->city}}" required autocomplete="city" autofocus>
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                <div class="col-md-6">
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$curuser->email}}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone_num" value="{{$curuser->phone_num}}" required autocomplete="phone" autofocus>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary" name="submit">
                        Edit User
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
