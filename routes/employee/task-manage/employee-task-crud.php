<?php

use App\Http\Controllers\Employee\TaskManage\Crud\EmployeeTaskCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('employee')->group(function(){
    Route::resource('task-manage',EmployeeTaskCrudController::class)->except(['destroy', 'show']);
    Route::post('task-manage/list',[EmployeeTaskCrudController::class,'list']);
    Route::post('task-manage/delete-list',[EmployeeTaskCrudController::class,'deleteList']);
    Route::post('task-manage/update-list',[EmployeeTaskCrudController::class,'updateList']);
    //vpx_attach
});
