<?php

use App\Http\Controllers\EntryController;
use App\Http\Controllers\ExampleFormController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::match(['get', 'post'], '/example_form', [ExampleFormController::class, 'index'])->name('example_form.index');
Route::match(['get', 'post'], '/example_form/confirm', [ExampleFormController::class, 'confirm'])->name('example_form.confirm');
Route::post('/example_form/thanks', [ExampleFormController::class, 'thanks'])->name('example_form.thanks');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::prefix('admin')->as('admin.')->group(function () {
        Route::resources(['entries' => EntryController::class], ['except' => ['create', 'store']]);
    });
});
