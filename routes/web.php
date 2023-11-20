<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use function Clue\StreamFilter\fun;

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

Route::get('/phpinfo', function() {
    return view('phpinfo');
});

Route::resource('/task_statuses', TaskStatusController::class)->except(['show']);

Route::resource('/tasks', TaskController::class);

// Route::get('/dashboard', function () {
//     return view('dashboard', [
//         'userIsLoggedIn' => Auth::check()
//     ]);
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
