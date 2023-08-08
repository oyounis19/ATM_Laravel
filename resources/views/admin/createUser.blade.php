@extends('layouts.admin')

@section('title', 'Users')

@section('heading', 'Create User')

@section('mngusrbtn', 'active')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{route('users.store')}}">
        @csrf
        @method('POST')

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
            <label for="Name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="Name" type="text" class="form-control @error('Name') is-invalid @enderror" name="name" value="{{ old('Name') }}" required autocomplete="Name" >

                @error('Name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>

            <div class="col-md-6">
                <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" required autocomplete="street" >

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
                <input id="area" type="text" class="form-control @error('area') is-invalid @enderror" name="area" value="{{ old('area') }}" required autocomplete="area" >

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
                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="State" >

                @error('city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" >

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

            <div class="col-md-6">
                <input id="phone" type="text" class="form-control @error('phone_num') is-invalid @enderror" name="phone_num" value="{{ old('phone_num') }}" required autocomplete="Phone Number" >

                @error('phone_num')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Fingerprint') }}</label>

            <div class="col-md-6">
                <input type="file" id="image" name="fingerprint" class="form-control @error('image') is-invalid @enderror">

                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="type" class="col-md-4 col-form-label text-md-right">Account Type</label>
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
                    {{ __('Create User') }}
                </button>
            </div>
        </div>
    </form>
@endsection
