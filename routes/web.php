<?php

use App\Http\Controllers\Admin\EntryController as AdminEntryController;
use App\Http\Controllers\EntryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::match(['get', 'post'], '/entries', [EntryController::class, 'index'])->name('entries.index');
Route::match(['get', 'post'], '/entries/confirm', [EntryController::class, 'confirm'])->name('entries.confirm');
Route::post('/entries/thanks', [EntryController::class, 'thanks'])->name('entries.thanks');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::prefix('admin')->as('admin.')->group(function () {
        Route::resources(['entries' => AdminEntryController::class], ['except' => ['create', 'store']]);
    });
});
