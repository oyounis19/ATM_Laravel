<?php

use App\Models\Card;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ATMLoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return Auth::guard('admin')->logout();
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**************************** Pass Test *******************************/

Route::get('/test/pass', function(){
    return Hash::make('12345678');
})->name('nn');

/**************************** Error Page *******************************/

Route::match(['get', 'post'], '/error/{errorCode}', function($errorCode){
    $user = Auth::user();
    return view('errors.error', compact('errorCode', 'user'));
})->name('errors.error')->middleware('auth:admin');

Route::prefix('admin')->group(function(){

    /**************************** Login *******************************/

    Route::get('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.login');

    Route::post('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login.submit');

    /**************************** Dashboard Page *******************************/

    Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');// IDK why but this must be below the previous 2 routes

    /**************************** Logout *******************************/

    Route::match(['get', 'post'], '/logout', [App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('admin.logout');

    /**************************** Create Admin Account *******************************/

    Route::get('/create/admin', function(){
        $user = Auth::user();
        return view('admin.createAdmin', compact('user'));
    })->name('admin.createAdmin')->middleware('auth:admin');

    Route::post('/create/admin', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.store')->middleware('auth:admin');

    /**************************** Accounts Controller *******************************/

    Route::resource('/accounts', App\Http\Controllers\AccountController::class)->middleware('auth:admin')->except(['show']);

    /**************************** Users Controller *******************************/

    Route::resource('/users', App\Http\Controllers\UsersController::class)->middleware('auth:admin')->except(['show']);

    /**************************** ATMs Controller *******************************/

    Route::resource('/atms', App\Http\Controllers\AtmController::class)->middleware('auth:admin')->except(['show']);

    /**************************** Find Card *******************************/

    Route::get('/find/card', function(){
        $user = Auth::user();
        return view('admin.findcard', compact('user'));
    })->name('admin.find.card')->middleware('auth:admin');

    Route::post('/find/card', [App\Http\Controllers\CardController::class, 'find'])->name('admin.card.find')->middleware('auth:admin');

    /**************************** Edit Card *******************************/

    Route::get('/edit/card/{id}', function($id){
        $user = Auth::user();
        $card = Card::findOrFail($id);
        return view('admin.editCard', compact('user', 'card'));
    })->name('admin.edit.card')->middleware('auth:admin');

    Route::put('/edit/card/{id}', [App\Http\Controllers\CardController::class, 'update'])->name('admin.card.edit')->middleware('auth:admin');
});
