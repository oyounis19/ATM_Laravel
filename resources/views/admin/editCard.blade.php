@extends('layouts.admin')

@section('title', 'Edit Card')

@section('heading', 'Edit Card')

@section('edtcrd', 'active')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form method="post" action="{{route('admin.card.edit', $card->id)}}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label for="state" class="col-md-4 col-form-label text-md-right">Status</label>
            <div class="col-md-6">
                <select id="state" class="form-control" name="state" required>
                    <option value="running" @if ($card->state == 'running') selected @endif>Running</option>
                    <option value="blocked" @if ($card->state == 'blocked') selected @endif>Blocked</option>
                </select>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary" name="submit">
                    Edit Card
                </button>
            </div>
        </div>
    </form>
    {{-- <form method="post" action="{{route('admin.edit.card')}}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label for="status">Status</label>
            <select id="status" class="form-control" name="status" required>
                <option value="running" selected>Running</option>
                <option value="blocked">Blocked</option>
            </select>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary" name="submit">
                    Edit Card
                </button>
            </div>
        </div>
    </form> --}}
@endsection
