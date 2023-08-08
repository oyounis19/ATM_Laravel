@extends('layouts.admin')

@section('title', 'Accounts')

@section('heading', 'View Accounts')

@section('mngAccbtn', 'active')

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
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Accounts Table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    {{-- <div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="dataTable_length"><label>Show <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div></div></div> --}}
                <div class="row">
                    <div class="col-sm-12">
                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 55.2px;">ID</th>
                            <th class="sorting"     tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 62.2px;">SSN</th>
                            <th class="sorting"     tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 48.2px;">Balance</th>
                            <th class="sorting"     tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 30.2px;">Type</th>
                            <th class="sorting"     tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 64.2px;">Number of Withdraws</th>
                            <th class="sorting"     tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 58px;">Total Withdraws Amount</th>
                            <th class="sorting"     tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 58px;">Number of Transfer</th>
                            <th class="sorting"     tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 58px;">Total Transfers Amount</th>
                            <th class="sorting"     tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 58px;">Edit</th>
                            <th class="sorting"     tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 58px;">Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th rowspan="1" colspan="1">ID</th>
                            <th rowspan="1" colspan="1">SSN</th>
                            <th rowspan="1" colspan="1">Balance</th>
                            <th rowspan="1" colspan="1">Type</th>
                            <th rowspan="1" colspan="1">Number of Withdraws</th>
                            <th rowspan="1" colspan="1">Total Withdraws Amount</th>
                            <th rowspan="1" colspan="1">Number of Transfer</th>
                            <th rowspan="1" colspan="1">Total Transfers Amount</th>
                            <th rowspan="1" colspan="1">Edit</th>
                            <th rowspan="1" colspan="1">Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        {{$i=0}}
                        @foreach ($accounts as $account)
                            {{$i++}}
                            <tr role="row" class="@if($i/2==0) even @else odd @endif">
                                <td class="sorting_1">{{$account->id}}</td>
                                <td>{{$account->ssn}}</td>
                                <td>{{$account->balance}}</td>
                                <td>{{$account->type}}</td>
                                <td>{{$account->num_of_withdraws}}</td>
                                <td>{{$account->total_withdraws}}</td>
                                <td>{{$account->num_of_transfers}}</td>
                                <td>{{$account->total_transfers}}</td>
                                <td><a href="{{route('accounts.edit', $account->id)}}">Edit</a></td>
                                <td>
                                    <form method="post" action="{{ route('accounts.destroy', $account->id) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table></div></div>
                    {{-- <div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="dataTable_previous"><a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="dataTable_next"><a href="#" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div> --}}
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
