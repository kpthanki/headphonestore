<?php

use App\Modules\Colour\Http\Controllers\ColourController;
use Illuminate\Support\Facades\Route;


Route::prefix('/admin/colour')->group(function() {
    Route::group(["middleware" => ["auth","adminmiddleware"]], function(){
    Route::get('/', 'ColourController@index')->name('colour.index');
    Route::get('/addcolour', [ColourController::class,'formdata'])->name('colour.add');
    Route::post('/addcolour', [ColourController::class,'getdata'])->name('colour.save');
    Route::post('/deletecolour', [ColourController::class,'deletedata'])->name('colour.delete');
    Route::post('/restore', [ColourController::class,'restore_data'])->name('colour.restore');
    Route::post('/changestatus', [ColourController::class,'changestatus']);
    Route::get('/edit/{id}', [ColourController::class,'edit']);
    Route::post('/update/{id}', [ColourController::class,'update']);
    Route::get('/trash', 'ColourController@showtrash')->name('colour.showtrash');
    Route::post('/restoretrash', 'ColourController@restoretrash')->name('colour.restoretrash');
    Route::get('/uniquename',[Colourcontroller::class,'uniquename']);

});
});

