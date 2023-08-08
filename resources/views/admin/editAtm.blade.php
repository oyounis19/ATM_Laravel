@extends('layouts.admin')

@section('title', 'Edit ATM')

@section('heading', 'Edit ATM')

@section('mngatmrbtn', 'active')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container-fluid">
        <form method="post" action="{{route('atms.update', $atm->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="City" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                <div class="col-md-6">
                    <input id="City" type="text" class="form-control @error('City') is-invalid @enderror" name="city" value="{{$atm->city}}" required autocomplete="City" autofocus>
                    @error('City')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>
                <div class="col-md-6">
                    <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{$atm->street}}" required autocomplete="street">
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
                    <input id="area" type="text" class="form-control @error('area') is-invalid @enderror" name="area" value="{{$atm->area}}" required autocomplete="area" >
                    @error('area')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="Balance" class="col-md-4 col-form-label text-md-right">{{ __('Balance') }}</label>
                <div class="col-md-6">
                    <input id="Balance" type="text" class="form-control @error('Balance') is-invalid @enderror" name="balance" value="{{$atm->balance}}" required autocomplete="Balance">
                    @error('Balance')
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
