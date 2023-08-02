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

//Admin
Route::get('/admin', function () {
    return view('admin.dashboard.index');
});

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

//Commerce
Route::get('/commerce', function () {
    return view('commerce.dashboard.gpm');
})->name('commerce');

Route::get('/commerce-gpm', function () {
    return view('commerce.dashboard.gpm');
})->name('commerce-gpm');

Route::get('/commerce-cogs/form', function () {
    return view('commerce.reporting.cogs-form');
})->name('commerce-cogs-form');

Route::get('/commerce-cogs', function () {
    return view('commerce.reporting.cogs');
})->name('commerce-cogs');

Route::get('/commerce-revenue', function () {
    return view('commerce.reporting.revenue');
})->name('commerce-revenue');

Route::get('/commerce-revenue/form', function () {
    return view('commerce.reporting.revenue-form');
})->name('commerce-revenue-form');

//Finance
Route::get('/finance', function () {
    return view('finance.dashboard.index');
})->name('finance-index');

Route::get('/finance/form', function () {
    return view('finance.reporting.form');
})->name('finance-form');

Route::get('/finance/reporting/kkp-operasional', function () {
    return view('finance.reporting.kkp');
})->name('finance-reporting-kkp');

Route::get('/finance/kkp-operasional', function () {
    return view('finance.dashboard.kkp');
})->name('finance-kkp');

Route::get('/users', [UserController::class, 'index'])->name('users.index');


// ------------- ADMIN ------------- 
Route::get('/city', [App\Http\Controllers\CityController::class, 'index'])->name('admin.dashboard.city');
Route::post('/city/add', [App\Http\Controllers\CityController::class, 'storeCity'])->name('admin.storeCity');
Route::get('/city/deleteCity/{id}', [App\Http\Controllers\CityController::class, 'deleteCity'])->name('admin.deleteCity');
Route::post('/city/update/{id}', [App\Http\Controllers\CityController::class, 'updateCity'])->name('admin.updateCity');

Route::get('/role', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.dashboard.role');

Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('admin.dashboard.account');
Route::post('/account/add', [App\Http\Controllers\AccountController::class, 'storeAccount'])->name('admin.storeAccount');
Route::get('/account/deleteAccount/{id}', [App\Http\Controllers\AccountController::class, 'deleteAccount'])->name('admin.deleteAccount');
Route::post('/account/update/{id}', [App\Http\Controllers\AccountController::class, 'updateAccount'])->name('admin.updateAccount');
        
Route::get('/sub', [App\Http\Controllers\SubGrupAkunController::class, 'index'])->name('admin.dashboard.sub');
Route::post('/sub/add', [App\Http\Controllers\SubGrupAkunController::class, 'storeSub'])->name('admin.storeSub');
Route::get('/sub/deleteCity/{id}', [App\Http\Controllers\SubGrupAkunController::class, 'deleteSub'])->name('admin.deleteSub');
Route::post('/sub/update/{id}', [App\Http\Controllers\SubGrupAkunController::class, 'updateSub'])->name('admin.updateSub');

Route::get('/peruntukan', [App\Http\Controllers\PeruntukanController::class, 'index'])->name('admin.dashboard.peruntukan');
Route::post('/peruntukan/add', [App\Http\Controllers\PeruntukanController::class, 'storePeruntukan'])->name('admin.storePeruntukan');
Route::get('/peruntukan/deleteCity/{id}', [App\Http\Controllers\PeruntukanController::class, 'deletePeruntukan'])->name('admin.deletePeruntukan');
Route::post('/peruntukan/update/{id}', [App\Http\Controllers\PeruntukanController::class, 'updatePeruntukan'])->name('admin.updatePeruntukan');

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