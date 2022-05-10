<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return Inertia::render('NoteList', ['test' => 'working']);
});

Route::get('/newNote', function () {
    return Inertia::render('CreateNote', ['about_us' => 'working']);
});
Route::get('/editNote/{id}', function ($id) {
    return Inertia::render('CreateNote', ['id' => $id]);
});
Route::get('/newCategory', function () {
    return Inertia::render('CreateCategory', ['useNav' => true]);
});