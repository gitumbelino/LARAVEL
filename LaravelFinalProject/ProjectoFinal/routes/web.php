<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BandController;

// =================================General==========================================================

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::fallback(function(){
    return view('fallback');
});


// =================================Users==========================================================

Route::get('/users', [UserController::class, 'allUsers'])->name('users.all');

//add users, get + post
Route::get('/users/add', [UserController::class, 'addUserForm'])->name('users.add');
Route::post('/users/add', [UserController::class, 'addUser'])->name('users.store');

//users view + delete
Route::get('/users/view/{id}', [UserController::class, 'viewUser'])->name('users.view');
Route::get('/delete-user/{id}', [UserController:: class, 'deleteUserFromDB'])->name('users.delete');

//dashboard
Route::get('/dashboard', [DashboardController::class,'getDashboard'])->name('dashboard.view')->middleware('auth');


// =================================Albums==========================================================

Route::get('/albums', [AlbumController::class, 'allAlbums'])->name('albums.all');

//add albums, get + post
Route::get('/albums/add', [AlbumController::class, 'addAlbumForm'])->name('albums.add')->middleware('auth');
Route::post('/albums/add', [AlbumController::class, 'addAlbum'])->name('albums.store')->middleware('auth');

//albums view + delete
Route::get('/album/{id}', [BandController::class, 'viewAlbum'])->name('album.view');
Route::get('/album/delete/{id}', [BandController::class, 'deleteAlbumFromDB'])->name('album.delete')->middleware('auth');

Route::get('/albums/edit/{id}', [AlbumController::class, 'editAlbumForm'])->name('albums.edit')->middleware('auth');
Route::post('/albums/update/{id}', [AlbumController::class, 'updateAlbum'])->name('albums.update')->middleware('auth');



// =================================Bands===========================================================

Route::get('/bands', [BandController::class, 'allBands'])->name('bands.all');

//add bands, get + post
Route::get('/bands/add', [BandController::class, 'addBandForm'])->name('bands.add');
Route::post('/bands/add', [BandController::class, 'addBand'])->name('bands.store');

//bands view + delete
Route::get('/bands/{id}', [BandController::class, 'viewBand'])->name('bands.view');
Route::get('/bands/delete/{id}', [BandController::class, 'deleteBandFromDB'])->name('bands.delete');







