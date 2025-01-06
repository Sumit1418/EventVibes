<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CompanyMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;


Route::get('/registration', function () {
    return view('users.registration');
});

Route::post('/registration', [AuthController::class, 'registration']);

//define / and /login for same balde users.login
Route::get('/', function () {
    return view('users.login');
});
Route::get('/login', function () {
    return view('users.login');
});

Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/resetpassword', function () {
    return view('users.resetpassword');
});

Route::get('/newpassword', function () {
    return view('users.newpassword');
});
// Routes for User
Route::middleware([UserMiddleware::class])->prefix('/user')->name('user-')->group(function () {
    Route::get('/home', function () {
        return view('users.home');
    })->name('home');

    Route::get('/bookings',[UserController::class, 'showbookings']);
    Route::get('/payments',[UserController::class, 'showtransactions']);

    Route::get('/userdetails',[UserController::class, 'showUserDetails'])->name('userdetails');
    Route::post('/userdetails',[UserController::class, 'updateUserDetails']);

    Route::get('/viewdetails',[UserController::class, 'viewDetails']);

    Route::get('/help', function (){
        return view('users.help');
    })->name('help');

    Route::post('/payment/create', [PaymentController::class, 'createPayment'])->name('payment.create');
    Route::post('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

});




// Routes for Company
Route::middleware([CompanyMiddleware::class])->prefix('/company')->name('company-')->group(function () {
    
    Route::get('/dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');

    Route::get('/bookings',[CompanyController::class, 'showbookings']);
    Route::get('/payments',[CompanyController::class, 'showtransactions']);

    Route::get('/companydetails',[CompanyController::class, 'showCompanyDetails'])->name('companydetails');
    Route::post('/companydetails',[CompanyController::class, 'updateCompanyDetails']);

    Route::get('/help', function (){
        return view('company.help');
    })->name('help');
});



Route::middleware([AdminMiddleware::class])->prefix('/admin')->name('admin-')->group(function () {

    Route::get('/dashboard',[AdminController::class, 'dashboard']);

    Route::get('/approvecompany',[AdminController::class, 'allcompanies']);

    Route::post('/changestatus',[AdminController::class, 'changestatus']);

});




