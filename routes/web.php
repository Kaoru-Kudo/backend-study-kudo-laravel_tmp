<?php

use App\Http\Controllers\ExampleFormController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::match(['get', 'post'], '/example_form', [ExampleFormController::class, 'index'])->name('example_form.index');
Route::match(['get', 'post'], '/example_form/confirm', [ExampleFormController::class, 'confirm'])->name('example_form.confirm');
Route::post('/example_form/thanks', [ExampleFormController::class, 'thanks'])->name('example_form.thanks');
