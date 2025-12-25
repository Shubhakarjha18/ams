<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

Route::controller(CompanyController::class)
    ->prefix('companies')
    ->name('companies.')
    ->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/delete/{id}', 'destroy')->name('destroy');
    });