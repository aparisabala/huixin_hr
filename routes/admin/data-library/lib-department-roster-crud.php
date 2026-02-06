<?php

use App\Http\Controllers\Admin\DataLibrary\Department\Crud\Roster\Crud\LibDepartmentRosterCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/department/crud/roster',LibDepartmentRosterCrudController::class)->except(['destroy', 'show']);
    Route::get('data-library/department/crud/roster/{lib_department_id}',[LibDepartmentRosterCrudController::class,'index']);
    Route::post('data-library/department/crud/roster/list',[LibDepartmentRosterCrudController::class,'list']);
    Route::post('data-library/department/crud/roster/delete-list',[LibDepartmentRosterCrudController::class,'deleteList']);
    Route::post('data-library/department/crud/roster/update-list',[LibDepartmentRosterCrudController::class,'updateList']);
    //vpx_attach
});


