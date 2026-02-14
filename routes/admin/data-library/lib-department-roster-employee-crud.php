<?php

use App\Http\Controllers\Admin\DataLibrary\Department\Crud\Roster\Crud\Crud\LibDepartmentRosterEmployeeCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){


    Route::resource('data-library/department/crud/roster-employee',LibDepartmentRosterEmployeeCrudController::class)->except(['destroy', 'show']);
    // index by roster id (SAME AS YOUR PREVIOUS)
    Route::get('data-library/department/crud/roster-employee/{lib_department_rosters_id}',[LibDepartmentRosterEmployeeCrudController::class, 'index']);
     
    // DATATABLE JSON
    Route::get('data-library/department/crud/roster-employee/{lib_department_rosters_id}/list',[LibDepartmentRosterEmployeeCrudController::class, 'list']);
    Route::post('data-library/department/crud/roster-employee/list',[LibDepartmentRosterEmployeeCrudController::class, 'list']);
    Route::post('data-library/department/crud/roster-employee/delete-list',[LibDepartmentRosterEmployeeCrudController::class, 'deleteList']);
    Route::post('data-library/department/crud/roster-employee/update-list',[LibDepartmentRosterEmployeeCrudController::class, 'updateList']);
    //vpx_attach
});

