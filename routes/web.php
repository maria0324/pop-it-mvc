<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/first_page', [Controller\Site::class, 'first_page']);
Route::add(['GET', 'POST'], '/add_patient', [Controller\Site::class, 'add_patient']);
Route::add(['GET', 'POST'], '/add_doctor', [Controller\Site::class, 'add_doctor']);
Route::add(['GET', 'POST'], '/add_reseption', [Controller\Site::class, 'add_reseption']);
Route::add(['GET', 'POST'], '/doctor', [Controller\Site::class, 'doctor']);
Route::add(['GET', 'POST'], '/record', [Controller\Site::class, 'record']);
Route::add(['GET', 'POST'], '/patient', [Controller\Site::class, 'patient']);
Route::add(['GET', 'POST'], '/admin', [Controller\Admin::class, 'admin'])
    ->middleware('auth', 'role');