@extends('layouts.admin')

@section('title', 'Create Admin')

@section('heading', 'Create Admin')

@section('createbtnActive', 'active')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{route('admin.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="fname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
            <div class="col-md-6">
                <input id="fname" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="title" autofocus>
                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="lname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

            <div class="col-md-6">
                <input id="lname" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="title" >

                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="uname" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

            <div class="col-md-6">
                <input id="uname" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="title" >

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="pass" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="pass" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="title" >

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>
            <div class="col-md-6">
                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                    <option value="Admin" {{ old('role') === 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Technician" {{ old('role') === 'Technician' ? 'selected' : '' }}>Technician</option>
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
