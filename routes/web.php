<?php
/* Routes:
    - Navigate the user through the program, this is for declaring routes
    - Resource route makes CRUD functions
*/


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\SongController as AdminSongController;
use App\Http\Controllers\user\SongController as UserSongController;



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

Route::resource('admin/songs',AdminSongController::class)->names('admin.songs');
Route::resource('user/songs',UserSongController::class)->middleware(['auth'])->names('user.songs')->only(['index','show']);

//debugging login error

// use App\Models\User;

// Route::get('/test-login', function () {
//     $user = User::where('email', 'alannah@olus.education')->first();

//     if ($user && password_verify('Jaaab2004', $user->password)) {
//         // Passwords match
//         dd('Passwords match');
//     } else {
//         // Passwords do not match
//         dd('Passwords do not match');
//     }
// });

require __DIR__.'/auth.php';
