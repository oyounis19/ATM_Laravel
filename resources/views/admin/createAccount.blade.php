@extends('layouts.admin')

@section('title', 'Create Account')

@section('heading', 'Create Account')

@section('mngAccbtn', 'active')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{route('accounts.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="ssn" class="col-md-4 col-form-label text-md-right">{{ __('SSN') }}</label>
            <div class="col-md-6">
                <input id="ssn" type="text" class="form-control @error('ssn') is-invalid @enderror" name="ssn" value="{{ old('SSN') }}" required autocomplete="ssn" autofocus>
                @error('ssn')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
            <div class="col-md-6">
                <select id="type" class="form-control" name="type" required>
                    <option value="saving" selected >Saving</option>
                    <option value="gold">Gold</option>
                    <option value="current">Current</option>
                </select>
            </div>
            @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary" name="submit">
                    {{ __('Create Account') }}
                </button>
            </div>
        </div>
    </form>
@endsection
