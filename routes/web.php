<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'revalidate'], function () {
    Route::group(['middleware' => ['auth:account', 'account-access:Commerce']], function () {
        //Commerce
        // Route::get('/commerce/dashboard', [App\Http\Controllers\LaporanCommerceController::class, 'indexChart'])->name('commerce.dashboard.chart');
        Route::get('/dashboard/gpm', [App\Http\Controllers\GpmController::class, 'index'])->name('commerce.dashboard.gpm');
        Route::get('/dashboard/revenue', [App\Http\Controllers\RevenueController::class, 'index'])->name('commerce.dashboard.revenue');
        Route::get('/dashboard/cogs', [App\Http\Controllers\CogsController::class, 'index'])->name('commerce.dashboard.cogs');
        Route::get('/commerce/dashboard', [App\Http\Controllers\LaporanCommerceController::class, 'indexChart'])->name('commerce.dashboard.chart');
        Route::get('/commerce', [App\Http\Controllers\LaporanCommerceController::class, 'index'])->name('commerce.dashboard.index');
        Route::get('/commerce/add', [App\Http\Controllers\LaporanCommerceController::class, 'addLaporanCommerce'])->name('commerce.reporting.form');
        Route::post('/commerce/add/success', [App\Http\Controllers\LaporanCommerceController::class, 'storeLaporanCommerce'])->name('commerce.storeLaporanCommerce');
        Route::get('/commerce/delete/{id}', [App\Http\Controllers\LaporanCommerceController::class, 'deleteLaporanCommerce'])->name('commerce.deleteLaporanCommerce');
        Route::get('/commerce/edit/{id}', [App\Http\Controllers\LaporanCommerceController::class, 'editLaporanCommerce'])->name('commerce.editLaporanCommerce');
        Route::post('/commerce/edit/{id}/success', [App\Http\Controllers\LaporanCommerceController::class, 'updateLaporanCommerce'])->name('commerce.updateLaporanCommerce');

        Route::get('/exportcom', [App\Http\Controllers\LaporanCommerceController::class, 'export'])->name('commerce.dashboard.export');
    });

    Route::group(['middleware' => ['auth:account', 'account-access:Finance']], function () {
        //Finance
        // Route::get('/finance/dashboard', [App\Http\Controllers\LaporanFinanceController::class, 'indexChart'])->name('finance.dashboard.chart');
        Route::get('/finance/dashboard', [App\Http\Controllers\KkpController::class, 'index'])->name('finance.dashboard.chart');
        Route::get('/finance', [App\Http\Controllers\LaporanFinanceController::class, 'index'])->name('finance.dashboard.index');
        Route::get('/finance/add', [App\Http\Controllers\LaporanFinanceController::class, 'addLaporanFinance'])->name('finance.reporting.form');
        Route::post('/finance/getprogram', [App\Http\Controllers\LaporanFinanceController::class, 'dependentDropdownProgram'])->name('finance.reporting.getProgram');
        Route::post('/finance/add/success', [App\Http\Controllers\LaporanFinanceController::class, 'storeLaporanFinance'])->name('finance.storeLaporanFinance');
        Route::get('/finance/delete/{id}', [App\Http\Controllers\LaporanFinanceController::class, 'deleteLaporanFinance'])->name('finance.deleteLaporanFinance');
        Route::get('/finance/edit/{id}', [App\Http\Controllers\LaporanFinanceController::class, 'editLaporanFinance'])->name('finance.editLaporanFinance');
        Route::post('/finance/edit/{id}/success', [App\Http\Controllers\LaporanFinanceController::class, 'updateLaporanFinance'])->name('finance.updateLaporanFinance');

        Route::get('/finance/exportfin', [App\Http\Controllers\LaporanFinanceController::class, 'export'])->name('finance.dashboard.export');

        // Route::get('/finance/dashboard', [App\Http\Controllers\KkpController::class, 'index'])->name('finance.dashboard.chart');
        Route::get('/nota', [App\Http\Controllers\LaporanNotaController::class, 'index'])->name('nota.dashboard.index');
        Route::get('/nota/add', [App\Http\Controllers\LaporanNotaController::class, 'addLaporanNota'])->name('nota.reporting.form');
        Route::post('/nota/add/success', [App\Http\Controllers\LaporanNotaController::class, 'storeLaporanNota'])->name('nota.storeLaporanNota');
        Route::get('/nota/delete/{id}', [App\Http\Controllers\LaporanNotaController::class, 'deleteLaporanNota'])->name('nota.deleteLaporanNota');
        Route::get('/nota/edit/{id}', [App\Http\Controllers\LaporanNotaController::class, 'editLaporanNota'])->name('nota.editLaporanNota');
        Route::post('/nota/edit/{id}/success', [App\Http\Controllers\LaporanNotaController::class, 'updateLaporanNota'])->name('nota.updateLaporanNota');

        Route::get('/nota/exportnota', [App\Http\Controllers\LaporanNotaController::class, 'export'])->name('nota.dashboard.export');

    });

    Route::group(['middleware' => ['auth:account', 'account-access:GM']], function () {

        Route::get('/manager-cogs', [App\Http\Controllers\CogsController::class, 'index'])->name('manager-cogs');
        Route::get('/manager', [App\Http\Controllers\GpmController::class, 'index'])->name('manager.dashboard');
        Route::get('/manager-revenue', [App\Http\Controllers\RevenueController::class, 'index'])->name('manager-revenue');
        Route::get('/manager-kkp', [App\Http\Controllers\KkpController::class, 'index'])->name('manager-kkp');
        Route::get('/manager/target', [App\Http\Controllers\TargetController::class, 'index'])->name('manager.dashboard.target');
        Route::get('/manager/target-kkp', [App\Http\Controllers\TargetFinanceController::class, 'index'])->name('manager.dashboard.target-finance');
        Route::get('/manager/finance', [App\Http\Controllers\LaporanFinanceController::class, 'index'])->name('manager.dashboard.finance');
        Route::get('/manager/nota', [App\Http\Controllers\LaporanNotaController::class, 'index'])->name('manager.dashboard.nota');
        Route::get('/manager/commerce', [App\Http\Controllers\LaporanCommerceController::class, 'index'])->name('manager.dashboard.commerce');

        Route::get('manager/commerce/exportcom', [App\Http\Controllers\LaporanCommerceController::class, 'export'])->name('manager.commerce.dashboard.export');
        Route::get('manager/finance/exportfin', [App\Http\Controllers\LaporanFinanceController::class, 'export'])->name('manager.finance.dashboard.export');
        Route::get('manager/nota/exportnota', [App\Http\Controllers\LaporanNotaController::class, 'export'])->name('manager.nota.dashboard.export');

    });

    Route::group(['middleware' => ['auth:account', 'account-access:Admin']], function () {

        Route::get('/admin', [App\Http\Controllers\GpmController::class, 'index'])->name('admin.dashboard');

        Route::get('/admin-cogs', [App\Http\Controllers\CogsController::class, 'index'])->name('admin-cogs');
        Route::get('/admin-revenue', [App\Http\Controllers\RevenueController::class, 'index'])->name('admin-revenue');
        Route::get('/admin-kkp', [App\Http\Controllers\KkpController::class, 'index'])->name('admin-kkp');
        // Route::get('/admin-gpm', [App\Http\Controllers\GpmController::class, 'index'])->name('admin-gpm');

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
        Route::get('/sub/deleteSub/{id}', [App\Http\Controllers\SubGrupAkunController::class, 'deleteSub'])->name('admin.deleteSub');
        Route::post('/sub/update/{id}', [App\Http\Controllers\SubGrupAkunController::class, 'updateSub'])->name('admin.updateSub');

        Route::get('/peruntukan', [App\Http\Controllers\PeruntukanController::class, 'index'])->name('admin.dashboard.peruntukan');
        Route::post('/peruntukan/add', [App\Http\Controllers\PeruntukanController::class, 'storePeruntukan'])->name('admin.storePeruntukan');
        Route::get('/peruntukan/deletePeruntukan/{id}', [App\Http\Controllers\PeruntukanController::class, 'deletePeruntukan'])->name('admin.deletePeruntukan');
        Route::post('/peruntukan/update/{id}', [App\Http\Controllers\PeruntukanController::class, 'updatePeruntukan'])->name('admin.updatePeruntukan');

        Route::get('/portofolio', [App\Http\Controllers\PortofolioController::class, 'index'])->name('admin.dashboard.portofolio');
        Route::post('/portofolio/add', [App\Http\Controllers\PortofolioController::class, 'storePortofolio'])->name('admin.storePortofolio');
        Route::get('/portofolio/deletePortofolio/{id}', [App\Http\Controllers\PortofolioController::class, 'deletePortofolio'])->name('admin.deletePortofolio');
        Route::post('/portofolio/update/{id}', [App\Http\Controllers\PortofolioController::class, 'updatePortofolio'])->name('admin.updatePortofolio');

        Route::get('/program', [App\Http\Controllers\ProgramController::class, 'index'])->name('admin.dashboard.program');
        Route::post('/program/add', [App\Http\Controllers\ProgramController::class, 'storeProgram'])->name('admin.storeProgram');
        Route::get('/program/deleteProgram/{id}', [App\Http\Controllers\ProgramController::class, 'deleteProgram'])->name('admin.deleteProgram');
        Route::post('/program/update/{id}', [App\Http\Controllers\ProgramController::class, 'updateProgram'])->name('admin.updateProgram');
        Route::post('/program/getPortofolio', [App\Http\Controllers\ProgramController::class, 'dependentDropdownRole'])->name('admin.getPorto');
    


        Route::get('/costplan', [App\Http\Controllers\CostPlanController::class, 'index'])->name('admin.dashboard.cost_plan');
        Route::post('/costplan/add', [App\Http\Controllers\CostPlanController::class, 'storeCostPlan'])->name('admin.storeCostPlan');
        Route::get('/costplan/deleteCostPlan/{id}', [App\Http\Controllers\CostPlanController::class, 'deleteCostPlan'])->name('admin.deleteCostPlan');
        Route::post('/costplan/update/{id}', [App\Http\Controllers\CostPlanController::class, 'updateCostPlan'])->name('admin.updateCostPlan');

        Route::get('/userreco', [App\Http\Controllers\UserRecoController::class, 'index'])->name('admin.dashboard.user_reco');
        Route::post('/userreco/add', [App\Http\Controllers\UserRecoController::class, 'storeUserReco'])->name('admin.storeUserReco');
        Route::get('/userreco/deleteUserReco/{id}', [App\Http\Controllers\UserRecoController::class, 'deleteUserReco'])->name('admin.deleteUserReco');
        Route::post('/userreco/update/{id}', [App\Http\Controllers\UserRecoController::class, 'updateUserReco'])->name('admin.updateUserReco');

        Route::get('/target', [App\Http\Controllers\TargetController::class, 'index'])->name('admin.dashboard.target');
        Route::post('/target/add', [App\Http\Controllers\TargetController::class, 'storeTarget'])->name('admin.storeTarget');
        Route::get('/target/deleteTarget/{id}', [App\Http\Controllers\TargetController::class, 'deleteTarget'])->name('admin.deleteTarget');
        Route::post('/target/update/{id}', [App\Http\Controllers\TargetController::class, 'updateTarget'])->name('admin.updateTarget');

        Route::get('/target-kkp', [App\Http\Controllers\TargetFinanceController::class, 'index'])->name('admin.dashboard.target-finance');
        Route::post('/target-kkp/add', [App\Http\Controllers\TargetFinanceController::class, 'storeTargetFinance'])->name('admin.storeTargetFinance');
        Route::get('/target-kkp/deleteTarget/{id}', [App\Http\Controllers\TargetFinanceController::class, 'deleteTargetFinance'])->name('admin.deleteTargetFinance');
        Route::post('/target-kkp/update/{id}', [App\Http\Controllers\TargetFinanceController::class, 'updateTargetFinance'])->name('admin.updateTargetFinance');

        Route::get('/admin/finance', [App\Http\Controllers\LaporanFinanceController::class, 'index'])->name('admin.dashboard.finance');
        Route::get('admin/finance/editable/{id}', [App\Http\Controllers\LaporanFinanceController::class, 'Editable'])->name('admin.editableFinance');
        Route::get('admin/finance/uneditable/{id}', [App\Http\Controllers\LaporanFinanceController::class, 'Uneditable'])->name('admin.uneditableFinance');

        Route::get('/admin/nota', [App\Http\Controllers\LaporanNotaController::class, 'index'])->name('admin.dashboard.nota');
        Route::get('admin/nota/editable/{id}', [App\Http\Controllers\LaporanNotaController::class, 'Editable'])->name('admin.editableNota');
        Route::get('admin/nota/uneditable/{id}', [App\Http\Controllers\LaporanNotaController::class, 'Uneditable'])->name('admin.uneditableNota');

        Route::get('/admin/commerce', [App\Http\Controllers\LaporanCommerceController::class, 'index'])->name('admin.dashboard.commerce');
        Route::get('admin/commerce/editable/{id}', [App\Http\Controllers\LaporanCommerceController::class, 'Editable'])->name('admin.editableCommerce');
        Route::get('admin/commerce/uneditable/{id}', [App\Http\Controllers\LaporanCommerceController::class, 'Uneditable'])->name('admin.uneditableCommerce');

        Route::get('admin/commerce/exportcom', [App\Http\Controllers\LaporanCommerceController::class, 'export'])->name('admin.commerce.dashboard.export');
        Route::get('admin/finance/exportfin', [App\Http\Controllers\LaporanFinanceController::class, 'export'])->name('admin.finance.dashboard.export');
        Route::get('admin/nota/exportnota', [App\Http\Controllers\LaporanNotaController::class, 'export'])->name('admin.nota.dashboard.export');
    });

    Route::post('/', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
    Route::get('/', [\App\Http\Controllers\LoginController::class, 'formLogin'])->name('login');
    Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
    Route::get('/register', function () {
        return view('auth.register');
    });
});