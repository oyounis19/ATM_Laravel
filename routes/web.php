<?php

use App\Models\Card;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**************************** Pass Test *******************************/

Route::get('/test/pass', function(){
    return Hash::make('1234');
})->name('nn');

/**************************** Error Page *******************************/

Route::match(['get', 'post'], '/error/{errorCode}', function($errorCode){
    $user = Auth::user();
    return view('errors.error', compact('errorCode', 'user'));
})->name('errors.error')->middleware('auth:admin');



/**************************** ADMIN *******************************/

Route::prefix('admin')->group(function(){

    /**************************** Login *******************************/

    Route::get('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.login');

    Route::post('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login.submit');

    /**************************** Dashboard Page *******************************/

    Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');// IDK why but this must be below the previous 2 routes

    /**************************** Logout *******************************/

    Route::match(['get', 'post'], '/logout', [App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth:admin'])->group(function(){

        /**************************** Create Admin Account *******************************/

        Route::get('/create/admin', function(){
            $user = Auth::user();
            return view('admin.createAdmin', compact('user'));
        })->name('admin.createAdmin');

        Route::post('/create/admin', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.store');

        /**************************** Accounts Controller *******************************/

        Route::resource('/accounts', App\Http\Controllers\AccountController::class)->except(['show']);

        /**************************** Users Controller *******************************/

        Route::resource('/users', App\Http\Controllers\UsersController::class)->except(['show']);

        /**************************** ATMs Controller *******************************/

        Route::resource('/atms', App\Http\Controllers\AtmController::class)->except(['show']);

        /**************************** Find Card *******************************/

        Route::get('/find/card', function(){
            $user = Auth::user();
            return view('admin.findcard', compact('user'));
        })->name('admin.find.card');

        Route::post('/find/card', [App\Http\Controllers\CardController::class, 'find'])->name('admin.card.find');

        /**************************** Edit Card *******************************/

        Route::get('/edit/card/{id}', function($id){
            $user = Auth::user();
            $card = Card::findOrFail($id);
            return view('admin.editCard', compact('user', 'card'));
        })->name('admin.edit.card');

        Route::put('/edit/card/{id}', [App\Http\Controllers\CardController::class, 'update'])->name('admin.card.edit');
    });
});

/**************************** ATM ********************************/

    /**************************** Login *******************************/

Route::get('/', [App\Http\Controllers\Auth\UserLoginController::class, 'showLoginForm'])->name('atm.login');

// CC Login
Route::post('/', [App\Http\Controllers\Auth\UserLoginController::class, 'login'])->name('atm.login.submit');

//Fingerprint Login
// Route::post('/fingerprint/login', [App\Http\Controllers\Auth\UserLoginController::class, 'fpLogin'])->name('atm.login.fingerprint');

Route::match(['get', 'post'], '/logout', [App\Http\Controllers\Auth\UserLoginController::class, 'logout'])->name('atm.logout');

Route::get('/accounts', [App\Http\Controllers\AtmUsersController::class, 'accounts'])->name('atm.account');

Route::post('/accounts/{id}', [App\Http\Controllers\AtmUsersController::class, 'selectAccount'])->name('account.select');

Route::get('/menu', [App\Http\Controllers\AtmUsersController::class, 'showMenu'])->name('atm.menu');

/************************* TECHNICIAN ****************************/

        /**************************** Login *******************************/


// Route::post('/login', [App\Http\Controllers\Auth\TechnicianLoginController::class, 'login'])->name('tech.login.submit');


// Route::middleware(['auth:tech'])->group(function(){

// });
