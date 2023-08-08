@extends('layouts.admin')

@section('title', 'Find Card')

@section('heading', 'Find Card')

@section('edtcrd', 'active')

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
    <form method="post" action="{{route('admin.card.find')}}">
        @csrf
        <div class="form-group row">
            <label for="fc" class="col-md-4 col-form-label text-md-right">{{ __('Card ID') }}</label>

            <div class="col-md-6">
                <input id="fc" type="text" class="form-control @error('cardid') is-invalid @enderror" name="id" value="{{ old('id') }}" required autocomplete="id" >

                @error('cardid')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary" name="submit">
                    Search Card
                </button>
            </div>
        </div>
    </form>
@endsection
