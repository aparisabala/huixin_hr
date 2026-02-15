<?php

use App\Http\Controllers\Admin\DataLibrary\Department\Crud\Roster\Modify\Load\AddRosterEmployee\AddRosterEmployeeLoadController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function () {
    Route::get('data-library/department/crud/roster/modify/add-roster-employee/{lib_department_roster_id}', [AddRosterEmployeeLoadController::class, 'index']);
    Route::post('data-library/department/crud/roster/modify/add-roster-employee/display', [AddRosterEmployeeLoadController::class, 'display']);
    Route::post('data-library/department/crud/roster/modify/add-roster-employee/store', [AddRosterEmployeeLoadController::class, 'store']);
    //vpx_attach
});
