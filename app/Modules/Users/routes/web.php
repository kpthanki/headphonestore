<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function () {
    Route::group(["middleware" => ["auth", "adminmiddleware"]], function () {
        Route::get('users', 'UsersController@welcome');
    });
});
