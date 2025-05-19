<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Mail\ProfileMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CreditController;
use App\Models\Compte;
use App\Models\Delete_request;
Route::get('/', [AdminController::class, 'main'])->name('home');
Route::get('/login', [AdminController::class, 'showinglogin'])->name('login');
Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

// Registration routes
Route::post('/register/Informations_personnelles', [AdminController::class, 'register_step1'])->name('register_step1');
Route::get('/register/Informations_personnelles', [AdminController::class, 'showregister'])->name('register_step1');
Route::get('/register/email_verification', [AdminController::class, 'showRegistration'])->name('email_veri');
Route::Post('/register/email_verification',[AdminController::class, 'verifyCode'])->name('email_verification');


Route::PATCH('/changeProfile',[AdminController::class,'changeProfile'])->name('changeProfile');

// Logout
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

Route::post('/comptes/creer',[AdminController::class,'createNewBankAccount'])->name('createNewBankAccount')->middleware('auth');

Route::get('/client/transactionshistory', [operationController::class, 'showtransactionsHistory'])->name('transactionsHistory')->middleware('auth');
Route::get('/client', [operationController::class, 'showoverview'])->name('client')->middleware('auth');
Route::get('/client/accounts', [operationController::class, 'showaccounts'])->name('accounts')->middleware('auth');
Route::get('/client/settings', [operationController::class, 'showsettings'])->name('settings');
Route::get('client/transactions', [operationController::class, 'showtransactions'])->name('transactions')->middleware('auth');
Route::post('/client/transactions', [TransactionController::class, 'faireTransactions'])->name('faireTransactions')->middleware('auth');
Route::get('/client/test', [operationController::class, 'test'])->name('test');
Route::post('/internal-transfer', [TransactionController::class, 'internalTransfer'])->name('internal_transfer');
Route::get('/client/cardinfo', [operationController::class, 'showcardinfo'])->name('cardinfo')->middleware('auth');
Route::get('client/credit', [operationController::class, 'showcredit'])->name('credit')->middleware('auth');
Route::post('/client/requestdelete', [operationController::class, 'requestdelete'])->name('requestdelete')->middleware('auth');
Route::post('/client/credit', [CreditController::class, 'submitCreditRequest'])->name('submitCreditRequest')->middleware('auth');