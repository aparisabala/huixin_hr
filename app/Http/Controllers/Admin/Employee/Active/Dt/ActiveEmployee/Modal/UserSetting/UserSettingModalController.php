<?php

namespace App\Http\Controllers\Admin\Employee\Active\Dt\ActiveEmployee\Modal\UserSetting;

use App\Http\Controllers\Controller;
use App\Traits\BaseTrait;
use Illuminate\Http\JsonResponse;
use View;
use Illuminate\Http\Request;
use App\Repositories\Admin\Employee\Active\Dt\ActiveEmployee\Modal\UserSetting\IUserSettingRepository;
//vpx_imports

class UserSettingModalController extends Controller
{

    use BaseTrait;
    public function __construct(private IUserSettingRepository $iUserSettingRepo)
    {
        $this->middleware(['auth:admin', 'HasAdminUserPassword', 'HasAdminUserAuth','SetAdminLanguage']);
        $this->lang = 'admin.employee.active.dt.active-employee.modal.user-setting';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });
    }

    /**
     * Loaded page for usersetting
     *
     * @param Request $request
     * @return View
     */
    public function display(Request $request): JsonResponse
    {
        $data['lang'] = $this->lang;
        $data = [...$data, ...$this->iUserSettingRepo->display($request)];
        $view = View::make('admin.pages.employee.active.dt.active-employee.modal.user-setting._modal', compact('data'))->render();
        $response = ['extraData' => ['inflate' => pxLang($data['lang'], '', 'common.response_success')], 'view' => $view];
        return $this->response(['type' => 'success', 'data' => $response]);
    }

    public function update(Request $request): JsonResponse
    {
        return $this->iUserSettingRepo->update($request);
    }
    //vpx_attach

}
