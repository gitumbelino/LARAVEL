<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GiftController;

Route::get('/', function () {
    return view('welcome');
});

// rota home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// rotas users
//rota para no futuro carregar uma tabela com todos os users
Route::get('/users', [UserController:: class, 'allUsers'])->name('users.show');


//rota que vai carregar uma blade com toda a info do user
Route::get('/users/{id}', [UserController:: class, 'viewUser'])->name('users.view');

Route::get('/delete-user/{id}', [UserController:: class, 'deleteUserFromDB'])->name('users.delete');

Route::get('/add-users', [UserController:: class, 'addUsers'])->name('users.add');


//add get too
Route::get('/create-user', [UserController::class, 'createUser'])->name('users.form');
Route::post('/create-user', [UserController::class, 'createUser'])->name('users.create');


//add get too
Route::get('/add-task', [TaskController::class, 'viewTaskForm'])->name('task.form');
Route::post('/add-task', [TaskController::class, 'createTask' ])->name('task.create');

//rota com paramentros
Route::get('/hello/{name}', function($name){
    return '<h1>Hello</h1>'.$name;
});

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.all');

Route::get('/view-task/{id}', [TaskController:: class, 'viewTask'])->name('tasks.view');

Route::get('/delete-task/{id}', [TaskController:: class, 'deleteTaskFromDB'])->name('tasks.delete');

//rota fallback: cai aqui quando não encontra nenhuma rota com o url solicitado no frontend
Route::fallback(function(){
    return view('fallback');
});


Route::get('/gifts', [GiftController::class, 'index'])->name('gifts.all');

Route::get('/gifts/{id}', [GiftController::class, 'viewGift'])->name('gifts.view');

Route::get('/delete-gift/{id}', [GiftController::class, 'deleteGiftFromDB'])->name('gifts.delete');

Route::get('/add-gift', [GiftController::class, 'viewGiftForm'])->name('gifts.form');

Route::post('/create-gift', [GiftController::class, 'createGift'])->name('gifts.create');

Route::put('/update-gift/{id}', [GiftController::class, 'updateGift'])->name('gifts.update');

