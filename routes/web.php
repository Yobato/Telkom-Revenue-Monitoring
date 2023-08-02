<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/admin', function () {
    return view('admin.dashboard.index');
});

Route::get('/commerce', function () {
    return view('commerce.dashboard.index');
})->name('commerce-index');

Route::get('/commerce-gpm', function () {
    return view('commerce.dashboard.gpm');
})->name('commerce-gpm');

Route::get('/commerce-form', function () {
    return view('commerce.dashboard.form');
})->name('commerce-form');

Route::get('/commerce-management', function () {
    return view('admin.users.commerce-management');
})->name('commerce-management');

Route::get('/finance-management', function () {
    return view('admin.users.finance-management');
})->name('finance-management');

Route::get('/gm-management', function () {
    return view('admin.users.gm-management');
})->name('gm-management');

Route::get('/create-user', function () {
    return view('admin.users.create');
})->name('create-user');

Route::get('/admin-gpm', function () {
    return view('admin.dashboard.gpm');
})->name('admin-gpm');

Route::get('/finance', function () {
    return view('finance.dashboard.index');
})->name('finance-index');

Route::get('/users', [UserController::class, 'index'])->name('users.index');



Route::get('/city', [App\Http\Controllers\CityController::class, 'index'])->name('admin.dashboard.city');
Route::post('/city/add', [App\Http\Controllers\CityController::class, 'storeCity'])->name('admin.storeCity');
Route::get('/city/deleteCity/{id}', [App\Http\Controllers\CityController::class, 'deleteCity'])->name('admin.deleteCity');
Route::post('/city/update/{id}', [App\Http\Controllers\CityController::class, 'updateCity'])->name('admin.updateCity');



// Route::get('home', function() {
//     return redirect(route('admin.dashboard'));
// });

// Route::name('admin.')->prefix('admin')->middleware('auth')->group(function() {
//     Route::get('dashboard', 'DashboardController')->name('dashboard');

//     Route::get('users/roles', 'UserController@roles')->name('users.roles');
//     Route::resource('users', 'UserController', [
//         'names' => [
//             'index' => 'users'
//         ]
//     ]);
// });

// Route::middleware('auth')->get('logout', function() {
//     Auth::logout();
//     return redirect(route('login'))->withInfo('You have successfully logged out!');
// })->name('logout');

// Auth::routes(['verify' => true]);

// Route::name('js.')->group(function() {
//     Route::get('dynamic.js', 'JsController@dynamic')->name('dynamic');
// });

// // Get authenticated user
// Route::get('users/auth', function() {
//     return response()->json(['user' => Auth::check() ? Auth::user() : false]);
// });