<?php

use App\Http\Controllers\Admin\DataLibrary\Shift\Crud\LibShiftCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/shift',LibShiftCrudController::class)->except(['destroy', 'show']);
    Route::post('data-library/shift/list',[LibShiftCrudController::class,'list']);
    Route::post('data-library/shift/delete-list',[LibShiftCrudController::class,'deleteList']);
    Route::post('data-library/shift/update-list',[LibShiftCrudController::class,'updateList']);
    //vpx_attach
});
