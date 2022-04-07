<?php

use Illuminate\Support\Facades\Route;
Route::prefix('/admin')->group(function() {
	Route::group(["middleware" => ["auth","adminmiddleware"]], function(){
        Route::get('/vieworder', [App\Modules\Orders\Http\Controllers\OrdersController::class, 'welcome']);
        Route::get('/invoice/{id}', [App\Modules\Orders\Http\Controllers\OrdersController::class, 'invoice']);
        Route::get('/edit/{id}', [App\Modules\Orders\Http\Controllers\OrdersController::class, 'edit']);
        Route::post('/update/{id}', [App\Modules\Orders\Http\Controllers\OrdersController::class,'update']);

    });
});

