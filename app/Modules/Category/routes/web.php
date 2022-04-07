<?php
use App\Modules\Category\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin/category')->group(function() {
	Route::group(["middleware" => ["auth","adminmiddleware"]], function(){
		Route::get('/', 'CategoryController@welcome')->name('category.index2');
        Route::get('/admin/category/uniquename',[CategoryController::class,'uniquename']);
		Route::get('addcategory', [CategoryController::class,'formdata'])->name('category.add');
		Route::post('addcategory', [CategoryController::class,'getdata'])->name('category.save');
		Route::post('deletecategory/', [CategoryController::class,'deletedata'])->name('category.delete');
		Route::post('/restore', [CategoryController::class,'restore_data'])->name('category.restore');
		// changeStatus
		Route::post('/changestatus', [CategoryController::class,'changestatus']);
        Route::get('/edit/{id}', [CategoryController::class,'editdata'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class,'update']);

		Route::post('/restoretrash', 'CategoryController@restoretrash')->name('category.restoretrash');
		Route::get('/trash', 'CategoryController@showtrash')->name('category.showtrash');
        Route::get('uniquename',[CategoryController::class,'uniquename']);
	});
});
