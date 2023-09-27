<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskStatusController;
use Illuminate\Support\Facades\Auth;
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
    return view('dashboard', [
        'userIsLoggedIn' => Auth::check()
    ]);
});

Route::resource('/task_statuses', TaskStatusController::class)->except(['show']);

// Route::get('/dashboard', function () {
//     return view('dashboard', [
//         'userIsLoggedIn' => Auth::check()
//     ]);
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
