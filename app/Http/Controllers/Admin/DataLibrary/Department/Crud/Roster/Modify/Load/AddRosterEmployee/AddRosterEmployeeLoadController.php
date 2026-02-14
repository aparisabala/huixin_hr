<?php

namespace App\Http\Controllers\Admin\DataLibrary\Department\Crud\Roster\Modify\Load\AddRosterEmployee;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\DataLibrary\Department\Crud\Roster\Modify\Load\AddRosterEmployee\IAddRosterEmployeeLoadRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View as ReturnView;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use View;
class AddRosterEmployeeLoadController extends Controller {

    use BaseTrait;
    public function __construct(private IAddRosterEmployeeLoadRepository $iAddRosterEmployeeLoadRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.department.crud.roster.modify.load';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for addrosteremployee crud
     *
     * @param Request $request
     * @return ReturnView
     */
    public function index(Request $request) : ReturnView
    {
        $data = $this->iAddRosterEmployeeLoadRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.department.crud.roster.modify.load.add-roster-employee.index',compact('data'));
    }

    /**
     * Load view 
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function display(Request $request) : JsonResponse
    {
        $data['lang'] = $this->lang;
        $data = [...$data,...$this->iAddRosterEmployeeLoadRepo->display($request)];
        $view = View::make('admin.pages.data-library.department.crud.roster.modify.load.add-roster-employee.fragments._display', compact('data'))->render();
        $response = ['extraData' => ['inflate' => pxLang($data['lang'],'','common.response_success')],'view' => $view];
        return $this->response(['type' => 'success', 'data' => $response]);
    }

}