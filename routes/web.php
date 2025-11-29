<?php

use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// Projects
Route::get('/iliad', function () {
    return view('iliad');
})->name('iliad');

Route::get('/color_purple', function () {
    return view('color_purple');
})->name('color_purple');

Route::get('/robert', function () {
    return view('robert');
})->name('robert');

Route::get('/project4', function () {
    return view('project4');
})->name('project4');

Route::get('/project5', function () {
    return view('project5');
})->name('project5');
