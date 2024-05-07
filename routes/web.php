<?php

use App\Http\Controllers\EntryController;
use App\Http\Controllers\ExampleFormController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::match(['get', 'post'], '/example_form', [ExampleFormController::class, 'index'])->name('example_form.index');
Route::match(['get', 'post'], '/example_form/confirm', [ExampleFormController::class, 'confirm'])->name('example_form.confirm');
Route::post('/example_form/thanks', [ExampleFormController::class, 'thanks'])->name('example_form.thanks');

Route::get('/admin/create',[UserController::class,'showCreate'])->name('admin.create');
Route::post('/admin/create',[UserController::class,'create']);

// Route::middleware('auth')->group(function (){
// });
Route::post('/logout',[UserController::class,'logout'])->name('user.logout');

Route::get('/login',[UserController::class,'showLogin'])->name('user.log
in');
Route::post('/login',[UserController::class,'login']);


Route::prefix('admin')->as('admin.')->group(function () {
    Route::resources(['entries' => EntryController::class], ['except' => ['create', 'store']]);
});