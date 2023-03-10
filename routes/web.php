<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;

use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\UserController;


use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserManageController;
use App\Http\Controllers\Admin\AffiliateManageController;



use App\Http\Controllers\Affiliate\Auth\AffiliateAuthenticatedSessionController;
use App\Http\Controllers\Affiliate\AffiliateController;
use App\Http\Controllers\Affiliate\SubAffiliateManageController;




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
    // dd('hello');
    return view('welcome');
});


Route::get('/affiliate_program', function () {
    // dd('hello1');
    return view('welcome');
});

Route::get('/home', [FrontEndController::class, 'index'])->name('home');

Route::post('/promo_code_validate', [FrontEndController::class, 'validePromoCode'])->name('validate.promo');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login')->middleware('guest:admin');

Route::post('/admin/login/store', [AuthenticatedSessionController::class, 'store'])->name('admin.login.store');

Route::group(['middleware' => 'admin'], function() {

    Route::get('/admin', [HomeController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/users', [UserManageController::class, 'index'])->name('admin.user.list');

    Route::get('/admin/affiliates', [AffiliateManageController::class, 'index'])->name('admin.affiliate.list');
    Route::get('/admin/affiliates/add', [AffiliateManageController::class, 'create'])->name('admin.affiliate.add');
    Route::post('/admin/affiliates/add', [AffiliateManageController::class, 'store']);

    Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');

    Route::get('/admin/user/transaction', [HomeController::class, 'userTransaction'])->name('admin.user.transaction');
    Route::get('/admin/affiliate/transaction', [HomeController::class, 'affiliateTransaction'])->name('admin.affiliate.transaction');

});


/*
|--------------------------------------------------------------------------
| Affiliate Routes
|--------------------------------------------------------------------------
*/

Route::get('/affiliate/login', [AffiliateAuthenticatedSessionController::class, 'create'])->name('affiliate.login')->middleware('guest:affiliate');

Route::post('/affiliate/login/store', [AffiliateAuthenticatedSessionController::class, 'store'])->name('affiliate.login.store');

Route::group(['middleware' => 'affiliate'], function() {

    Route::get('/affiliate', [AffiliateController::class, 'index'])->name('affiliate.dashboard');

    Route::post('/affiliate/logout', [AffiliateAuthenticatedSessionController::class, 'destroy'])->name('affiliate.logout');

    Route::get('/affiliate/sub_affiliates', [SubAffiliateManageController::class, 'index'])->name('affiliate.sub_affiliate.list');
    Route::get('/affiliate/sub_affiliates/add', [SubAffiliateManageController::class, 'create'])->name('affiliate.sub_affiliate.add');
    Route::post('/affiliate/sub_affiliates/add', [SubAffiliateManageController::class, 'store']);
    Route::get('/affiliate/sub_affiliates/commision', [SubAffiliateManageController::class, 'commision'])->name('affiliate.sub_affiliate.commision');

    Route::get('/affiliate/commision', [AffiliateController::class, 'commision'])->name('affiliate.commision');

   

});


/*
|--------------------------------------------------------------------------
| Normal User
|--------------------------------------------------------------------------
*/




Route::group(['middleware' => 'auth'], function() {

    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');

    Route::get('/user/balances', [UserController::class, 'list'])->name('user.balance.list');
    Route::get('/user/balances/add', [UserController::class, 'create'])->name('user.balance.add');
    Route::post('/user/balances/add', [UserController::class, 'store']);

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
