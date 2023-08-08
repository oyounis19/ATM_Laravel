@extends('layouts.admin')

@section('title', 'ATM')

@section('heading', 'View ATMs')

@section('mngatmrbtn', 'active')

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
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">ATMs Table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 55.2px;">ID</th>
                                        <th class="sorting"     tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 62.2px;">City</th>
                                        <th class="sorting"     tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 48.2px;">Street</th>
                                        <th class="sorting"     tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 30.2px;">Area</th>
                                        <th class="sorting"     tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 64.2px;">Balance</th>
                                        <th class="sorting"     tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 64.2px;">Edit</th>
                                        <th class="sorting"     tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 64.2px;">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{$i=0}}
                                    @foreach ($atms as $atm)
                                        {{$i++}}
                                        <tr role="row" class="@if($i/2==0) even @else odd @endif">
                                            <td>{{$atm->id}}</td>
                                            <td>{{$atm->city}}</td>
                                            <td>{{$atm->street}}</td>
                                            <td>{{$atm->area}}</td>
                                            <td>{{$atm->balance}}</td>
                                            <td><a href="{{route('atms.edit', $atm->id)}}">Edit</a></td>
                                            <td>
                                                <form method="post" action="{{ route('atms.destroy', $atm->id) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Delete" class="btn btn-danger">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">ID</th>
                                        <th rowspan="1" colspan="1">City</th>
                                        <th rowspan="1" colspan="1">Street</th>
                                        <th rowspan="1" colspan="1">Area</th>
                                        <th rowspan="1" colspan="1">Balance</th>
                                        <th rowspan="1" colspan="1">Edit</th>
                                        <th rowspan="1" colspan="1">Delete</th>
                                    </tr>
                                </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="d-flex">
        <div class="mx-auto">
            {{ $accounts->links() }} To get the pagination html to adjust there css run: php artisan vendor:publish then select pagination
        </div>
    </div> --}}
@endsection

@section('css')
    <link href="{{asset('css/datatables.min.css')}}" rel="stylesheet">
    {{-- <link href="{{asset('css/colReorder.bootstrap.min.css')}}" rel="stylesheet"> --}}
@endsection

@section('js')
    <script src="{{asset('js/datatables.min.js')}}"></script>
    {{-- <script src="{{asset('js/colReorder.bootstrap.min.js')}}"></script> --}}
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#dataTable').DataTable();
        });
    </script>
@endsection
