<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    $user = Auth::user();
    if ($user->role == 'admin') return redirect('/admin');
    return redirect('/staff');
})->name('home')->middleware('auth');

Route::get('/login', [EmployeeController::class, 'login'])->name('show-login')->middleware('guest');
Route::post('/login', [EmployeeController::class, 'auth'])->name('attempt-login')->middleware('guest');
Route::get('/logout', [EmployeeController::class, 'logout'])->name('logout')->middleware('auth');

Route::name('admin.')->prefix('/admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::get('/employee', [AdminController::class, 'employeePage'])->name('employee-page');
    Route::post('/employee', [EmployeeController::class, 'store']);
    Route::post('/employee/{employee}', [EmployeeController::class, 'update']);
    Route::delete('/employee/{employee}', [EmployeeController::class, 'destroy']);

    Route::get('/ingredient', [AdminController::class, 'ingredientPage'])->name('ingredient-page');
    Route::post('/ingredient', [IngredientController::class, 'store']);
    Route::post('/ingredient/{ingredient}', [IngredientController::class, 'update']);
    Route::delete('/ingredient/{ingredient}', [IngredientController::class, 'destroy']);

    Route::post('/measurement', [MeasurementController::class, 'store']);
    Route::post('/measurement/{measurement}', [MeasurementController::class, 'update']);
    Route::delete('/measurement/{measurement}', [MeasurementController::class, 'destroy']);

    Route::get('/restock', [AdminController::class, 'restockPage'])->name('restock-page');
    Route::post('/restock/{ingredient}', [IngredientController::class, 'restock']);

    Route::get('/menu', [AdminController::class, 'menuPage'])->name('menu-page');
    Route::post('/menu', [MenuController::class, 'store']);
    Route::get('/menu/{menu}', [AdminController::class, 'editMenu'])->name('edit-menu');
    Route::post('/menu/{menu}', [MenuController::class, 'update']);
    Route::delete('/menu/{menu}', [MenuController::class, 'destroy']);
    Route::post('/menu/{menu}/ingredient', [MenuController::class, 'storeIngredient']);
    Route::post('/menu/{menu}/ingredient/{ingredient}', [MenuController::class, 'updateIngredient']);
    Route::delete('/menu/{menu}/ingredient/{ingredient}', [MenuController::class, 'destroyIngredient']);

    Route::get('/kasir', [AdminController::class, 'kasirPage'])->name('kasir-page');
    Route::post('/kasir', [TransactionController::class, 'store']);

    Route::get('/transaction', [AdminController::class, 'transactionPage'])->name('transaction-page');
    Route::get('/transaction/{transaction}', [AdminController::class, 'detailTransaksi'])->name('detail-transaksi');
})->middleware('auth');

Route::name('staff.')->prefix('/staff')->group(function () {
    Route::get('/', [StaffController::class, 'index'])->name('index');
})->middleware('auth');