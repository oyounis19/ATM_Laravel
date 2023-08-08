<?php

use App\Models\Card;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\AdminLoginController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**************************** Create Admin Account *******************************/

Route::get('/admin/create/admin', function(){
    $user = Auth::user();
    return view('admin.createAdmin', compact('user'));
})->name('admin.createAdmin')->middleware('auth');

Route::post('/admin/create/admin', [App\Http\Controllers\EmployeeController::class, 'store'])->name('admin.store')->middleware('auth');

/**************************** Dashboard *******************************/

Route::get('/admin/dashboard', function(){
    $user = Auth::user();
    return view('admin.index', compact('user'));
})->name('admin.dashboard')->middleware('auth');

/**************************** Accounts Controller *******************************/

Route::resource('/admin/accounts', App\Http\Controllers\AccountController::class)->middleware('auth');

/**************************** Users Controller *******************************/

Route::resource('/admin/users', App\Http\Controllers\UsersController::class)->middleware('auth');

/**************************** ATMs Controller *******************************/

Route::resource('/admin/atms', App\Http\Controllers\AtmController::class)->middleware('auth');

/**************************** Find Card *******************************/

Route::get('/admin/find/card', function(){
    $user = Auth::user();
    return view('admin.findcard', compact('user'));
})->name('admin.find.card')->middleware('auth');

Route::post('/admin/find/card', [App\Http\Controllers\CardController::class, 'find'])->name('admin.card.find')->middleware('auth');

/**************************** Edit Card *******************************/

Route::get('/admin/edit/card/{id}', function($id){
    $user = Auth::user();
    $card = Card::findOrFail($id);
    return view('admin.editCard', compact('user', 'card'));
})->name('admin.edit.card')->middleware('auth');

Route::put('/admin/edit/card/{id}', [App\Http\Controllers\CardController::class, 'update'])->name('admin.card.edit')->middleware('auth');

/**************************** Pass Test *******************************/

Route::get('/test/pass', function(){
    return Hash::make('12345678');
})->name('nn');

/**************************** Error Page *******************************/

Route::match(['get', 'post'], '/error/{errorCode}', function($errorCode){
    $user = Auth::user();
    return view('errors.error', compact('errorCode', 'user'));
})->name('errors.error')->middleware('auth');



// // Admin login routes
// Route::prefix('admin')->group(function () {
//     Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
//     Route::post('/login', [AdminLoginController::class, 'login']);
//     // Add more admin routes as needed
//     Route::get('/admin/dashboard', function(){
//         $user = Auth::user();
//         return view('admin.index', compact('user'));
//     })->name('admin.dashboard');
// });



// // Client login routes
// Route::get('/login', [ATMLoginController::class, 'showLoginForm'])->name('client.login');
// Route::post('/login', [ATMLoginController::class, 'login']);
