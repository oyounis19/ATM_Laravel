@extends('layouts.atm')

@section('title', 'Menu')

@section('content')
<div class="screens bg d-flex">
    <div class="screen info">
        <h2 class="text-white fw-bolder">ATM</h2>
        <div class="userInfo my-5">
            <ul>
                <li class="text-white d-flex flex-column text-start fs-5 mb-3">
                    <span>Welcome</span>
                    {{$user->name}}
                </li>

                <li class="text-white d-flex flex-column text-start fs-5 mb-3">
                    <span>Balance</span>
                    {{number_format($account->balance)}}
                </li>

                <li class="text-white d-flex flex-column text-start fs-5 mb-3">
                    <span>Account id</span>
                    {{$account->id}}
                </li>
                <?php
                // if(isset($_SESSION['fing']) && $_SESSION['fing'] == 1){//User blocks card if he is logged in by fingerprint
                ?>
                    {{-- <li class="text-white d-flex flex-column text-start fs-5 mb-3">
                        <a href="Changepin">
                            Change PIN
                        </a>
                    </li> --}}
                <?php
                // }
                ?>
                <?php
                // if(!isset($_SESSION['oneAccountOnly'])){?>
                {{-- <li class="text-white d-flex flex-column text-start fs-5 mb-3">
                        <a href="Account">
                            Change Account
                        </a>
                </li> --}}
                <?php //}?>
            </ul>
        </div>
    </div>

    <div class="screen menu">
        <div class="buttons d-flex flex-wrap justify-content-between">
            <a href="withdraw" class="btn btnMenu">
                Withdraw
            </a>
            <a href="deposit" class="btn btnMenu">
                Deposit
            </a>
            <a href="transfer" class="btn btnMenu">
                Transfer
            </a>
            <a href="transaction" class="btn btnMenu">
                Transaction History
            </a>
            <form action="" style="width: 100%;" method="get">
                @if (session()->has('fingerprint'))
                    <button name="block" class="btn btnMenu btn-primary" id ="blockCard">
                        Block Card
                    </button>
                @endif
                <a name="lg_out" class="btn btnMenu btn-primary" style="font-weight: bold;" href="{{route('atm.logout')}}">
                    logOut
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
