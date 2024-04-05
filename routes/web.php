<?php

use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\InvoiceController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('invoice/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('invoice', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('invoice/{id}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
    Route::put('invoice/{id}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::get('invoice/{id}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
    Route::get('invoice/{id}/details', [InvoiceController::class, 'show'])->name('invoices.show');

    Route::get('add-invoice-items',[InvoiceController::class, 'addInvoiceItems'])->name('add-invoice-items');

    Route::get('generate-pdf', [InvoiceController::class, 'generatePDF'])->name('invoices.pdf');

    Route::get('logout', [AuthUserController::class, 'logout'])->name('logout');

});

Route::middleware('guest')->group(function () {
    Route::get('login',[AuthUserController::class, 'loginPage'])->name('login-page');
    Route::post('login',[AuthUserController::class, 'login'])->name('login');
});

