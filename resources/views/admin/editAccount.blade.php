@extends('layouts.admin')

@section('title', 'Edit Account')

@section('heading', 'Edit Account')

@section('mngAccbtn', 'active')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container-fluid">
        <form method="post" action="{{route('accounts.update', $account->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="type">Type</label>
                <select id="type" class="form-control" name="type" required>
                    <option value="Saving" @if ($account->type == 'saving') selected @endif>Saving</option>
                    <option value="Gold" @if ($account->type == 'gold') selected @endif>Gold</option>
                    <option value="Current" @if ($account->type == 'current') selected @endif>Current</option>
                </select>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary" name="submit">
                        Edit Account
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
