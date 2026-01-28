<?php

use App\Http\Controllers\Admin\Employee\Draft\Crud\Document\Crud\EmployeeDocumentCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('employee/draft/crud/document',EmployeeDocumentCrudController::class)->except(['destroy', 'show']);
     Route::get('employee/draft/crud/document/{uuid}',[EmployeeDocumentCrudController::class,'index']);
    Route::post('employee/draft/crud/document/list',[EmployeeDocumentCrudController::class,'list']);
    Route::post('employee/draft/crud/document/delete-list',[EmployeeDocumentCrudController::class,'deleteList']);
    Route::post('employee/draft/crud/document/update-list',[EmployeeDocumentCrudController::class,'updateList']);
    //vpx_attach
});
