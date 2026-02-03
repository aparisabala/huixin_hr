<?php

namespace App\Http\Controllers\Employee\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Contracts\View\View;
use App\Traits\BaseTrait;
//vpx_imports
class EmployeeDashboardController extends Controller
{
    use BaseTrait;
    public function __construct()
    {
        $this->middleware(['auth:employee', 'HasEmployeePassword', 'HasEmployeeAuth']);
    }

    /**
     * View Employee dashboard page
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        if (!request()->cookie('device_token')) {
            $user = Auth::user();
            $user->device_token = NULL;
            $user->device_ua = NULL;
            $user->save();
        }
        return view('employee.pages.dashboard.index');
    }
    //vpx_attach
}
