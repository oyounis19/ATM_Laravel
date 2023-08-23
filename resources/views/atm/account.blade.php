@extends('layouts.atm')

@section('title', 'Choose Account')

@section('content')
<div class="screens d-flex">
    <div class="screen account">
        <h2 class="text-white fw-bolder">Select Account</h2>

        <div id="accountForm" class="accounts">
            @if (session('selectedAccId'))
                @foreach ($accounts as $account)
                    <div class="account d-flex mt-4" data-form-id="accountForm_{{ $account->id }}">
                        <i class="fa-solid fa-credit-card"></i>
                        <form id="accountForm_{{ $account->id }}" action="{{ route('account.select', $account->id) }}" method="POST">
                            @csrf
                            <div class="accountInfo">
                                <ul>
                                    <li>
                                        <p>Account ID :
                                            <span>
                                                {{ $account->id }}
                                            </span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>Account Type :
                                            <span>
                                                {{ $account->type }}
                                            </span>
                                        </p>
                                        <p>Balance :
                                            <span>
                                                {{ number_format($account->balance) }}
                                            </span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                @endforeach
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <a href="{{route('atm.login')}}">
            <img src="assets/img/icons8-back-64.png" alt="Back button">
            <br>
            <b>Back</b>
        </a>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.account').on('click', function() {
            var formId = $(this).data('form-id');
            $('#' + formId).submit();
        });
    });
</script>
@endsection
