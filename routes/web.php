<?php
/* Routes:
    - Navigate the user through the program, this is for declaring routes
    - Resource route makes CRUD functions
*/


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\SongController as AdminSongController;
use App\Http\Controllers\user\SongController as UserSongController;
use App\Http\Controllers\editor\SongController as EditorSongController;

use App\Http\Controllers\admin\AlbumController as AdminAlbumController;
use App\Http\Controllers\user\AlbumController as UserAlbumController;
use App\Http\Controllers\editor\AlbumController as EditorAlbumController;


use App\Http\Controllers\admin\ArtistController as AdminArtistController;
use App\Http\Controllers\user\ArtistController as UserArtistController;
use App\Http\Controllers\editor\ArtistController as EditorArtistController;






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

//Song Controller
Route::resource('admin/songs',AdminSongController::class)->names('admin.songs');
Route::resource('user/songs',UserSongController::class)->middleware(['auth'])->names('user.songs')->only(['index','show']);
Route::resource('editor/songs',EditorSongController::class)->middleware(['auth'])->names('editor.songs')->only(['index','show','edit','update']);

//Album Controller
Route::resource('admin/albums',AdminAlbumController::class)->names('admin.albums');
Route::resource('user/albums',UserAlbumController::class)->middleware(['auth'])->names('user.albums')->only(['index','show']);
Route::resource('editor/albums',EditorAlbumController::class)->middleware(['auth'])->names('editor.albums')->only(['index','show','edit','update']);
//Artist Controller
Route::resource('/admin/artists', AdminArtistController::class)->middleware(['auth'])->names('admin.artists');
Route::resource('/user/artists', UserArtistController::class)->middleware(['auth'])->names('user.artists')->only(['index', 'show']);
Route::resource('editor/artist',EditorArtistController::class)->middleware(['auth'])->names('editor.artists')->only(['index','show','edit','update']);




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
