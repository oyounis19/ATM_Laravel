@extends('layouts.admin')

@section('title', 'ATM')

@section('heading', 'Create ATMs')

@section('mngatmrbtn', 'active')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{route('atms.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="City" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
            <div class="col-md-6">
                <input id="City" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('City') }}" required autocomplete="City" autofocus>
                @error('city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="Area" class="col-md-4 col-form-label text-md-right">{{ __('Area') }}</label>
            <div class="col-md-6">
                <input id="Area" type="text" class="form-control @error('area') is-invalid @enderror" name="area" value="{{ old('Area') }}" required autocomplete="Area" >
                @error('area')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="Street" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>
            <div class="col-md-6">
                <input id="Street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('Street') }}" required autocomplete="Street" >
                @error('street')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="Balance" class="col-md-4 col-form-label text-md-right">{{ __('Balance') }}</label>
            <div class="col-md-6">
                <input id="Balance" type="text" class="form-control @error('balance') is-invalid @enderror" name="balance" value="{{ old('Balance') }}" required autocomplete="Balance" >
                @error('balance')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary" name="submit">
                    {{ __('Create ATM') }}
                </button>
            </div>
        </div>
    </form>
@endsection
