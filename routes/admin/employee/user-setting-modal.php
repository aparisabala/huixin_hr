<?php

use App\Http\Controllers\Admin\Employee\Active\Dt\ActiveEmployee\Modal\UserSetting\UserSettingModalController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function () {
    Route::post('employee/active/dt/active-employee/user-setting/display', [UserSettingModalController::class, 'display']);
    Route::post('employee/active/dt/active-employee/user-setting/updatesplay', [UserSettingModalController::class, 'update']);
    //vpx_attach
});
