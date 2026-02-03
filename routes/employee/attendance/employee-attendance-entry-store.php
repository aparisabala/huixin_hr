<?php

use App\Http\Controllers\Employee\Attendance\Entry\Form\Store\EmployeeAttendanceEntryStoreController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('employee')->group(function () {
    Route::get('attendance/entry/store', [EmployeeAttendanceEntryStoreController::class, 'index']);
    Route::post('attendance/entry/store', [EmployeeAttendanceEntryStoreController::class, 'store']);
    Route::post('attendance/entry/update', [EmployeeAttendanceEntryStoreController::class, 'update']);
    Route::post('attendance/entry/bind', [EmployeeAttendanceEntryStoreController::class, 'bind']);
    //vpx_attach
});
