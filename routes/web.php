<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\FailedJobController;
use App\Jobs\FailJob;
use Illuminate\Support\Facades\Route;

// Mājas lapa
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Valodas maiņas maršruts (vienkāršs closure variants, neprasa kontrolieri)
Route::get('locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'lv'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('locale.switch');

// Aizsargāti maršruti tikai autorizētiem lietotājiem
Route::middleware('auth')->group(function () {
    // Profila iestatījumi
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Braucienu maršruti
    Route::resource('rides', RideController::class);
    Route::patch('/rides/{ride}/cancel', [RideController::class, 'cancel'])->name('rides.cancel');
    Route::get('/rides/select-edit', [RideController::class, 'selectEdit'])->name('rides.select-edit');

    // Neizdevušies darbi
    Route::get('/failed-jobs', [FailedJobController::class, 'index'])->name('failed-jobs.index');
    Route::post('/failed-jobs/{id}/retry', [FailedJobController::class, 'retry'])->name('failed-jobs.retry');
    Route::delete('/failed-jobs/{id}', [FailedJobController::class, 'forget'])->name('failed-jobs.forget');

    // Testa darbs, kas neizdodas
    Route::get('/test-fail-job', function () {
        dispatch(new FailJob());
        return 'Darbs nosūtīts rindā. Pārbaudi failed_jobs tabulu pēc pāris sekundēm.';
    });
});

// Reģistrācijas maršruti
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

// Autentifikācijas maršruti
require __DIR__.'/auth.php';
