<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Category Route
    Route::get('/apiCategoryList',[CategoryController::class, 'CategoryList']);
    Route::get('/apiGetCategory',[CategoryController::class, 'apiGetCategory']);
    Route::get('/apiCategoryShow/{id}',[CategoryController::class, 'CategoryShow']);
    Route::post('/apiCategoryCreate',[CategoryController::class, 'CategoryCreate']);
    Route::get('/category-page',[CategoryController::class, 'CategoryListPage'])->name('category-page');

    //Income Route
    Route::get('/apiIncomeList', [IncomeController::class, 'incomeList']);
    Route::post('/apiIncomeCreate', [IncomeController::class, 'addIncome']);
    Route::post('/apiIncomeUpdate/{id}', [IncomeController::class, 'updateIncome']);
    Route::post('/apiIncomeDelete/{id}', [IncomeController::class, 'deleteIncome']);
    Route::get('/income-page', [IncomeController::class, 'incomePage'])->name('income-page');

    //Expense Route
    Route::get('/apiExpenseList',[ExpenseController::class, 'expenseList']);
    Route::post('/apiExpenseAdd',[ExpenseController::class, 'expenseAdd']);
    Route::post('/apiExpenseUpdate/{id}',[ExpenseController::class, 'expenseAdd']);
    Route::post('/apiExpenseDelete/{id}',[ExpenseController::class, 'expenseAdd']);
    Route::get('/expense-page',[ExpenseController::class, 'expensePage'])->name('expense-page');
});

require __DIR__.'/auth.php';
