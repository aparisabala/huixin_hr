<?php

use App\Http\Controllers\Admin\DataLibrary\Documents\Crud\LibDocumentCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/documents',LibDocumentCrudController::class)->except(['destroy', 'show']);
    Route::post('data-library/documents/list',[LibDocumentCrudController::class,'list']);
    Route::post('data-library/documents/delete-list',[LibDocumentCrudController::class,'deleteList']);
    Route::post('data-library/documents/update-list',[LibDocumentCrudController::class,'updateList']);
    //vpx_attach
});
