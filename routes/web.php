<?php
/* Routes:
    - Navigate the user through the program, this is for declaring routes
    - Resource route makes CRUD functions
*/


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\SongController as AdminSongController;
use App\Http\Controllers\User\SongController as UserSongController;


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

//Landing Page
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//CRUD functionality
// Route::resource('/songs',SongController::class);

//CRUD functionality with user and admin

Route::resource('admin/songs',AdminSongController::class)->middleware(['auth'])->names('admin.songs');
Route::resource('user/songs',UserSongController::class)->middleware(['auth'])->names('user.songs')->only(['index','show']);

require __DIR__.'/auth.php';
