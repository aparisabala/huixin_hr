<?php

namespace App\Http\Controllers\Admin\DataLibrary\Department\Crud\Roster\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\Department\Crud\Roster\Crud\ValidateStoreLibDepartmentRoster;
use App\Repositories\Admin\DataLibrary\Department\Crud\Roster\Crud\ILibDepartmentRosterCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class LibDepartmentRosterCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ILibDepartmentRosterCrudRepository $iLibDepartmentRosterCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.department.crud.roster.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for libdepartmentroster crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iLibDepartmentRosterCrudRepo->index($request);
        $data['lang'] = $this->lang;
        $data['lib_department_id'] = $request->lib_department_id;
        return view('admin.pages.data-library.department.crud.roster.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for libdepartmentroster crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iLibDepartmentRosterCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreLibDepartmentRoster $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibDepartmentRoster $request): JsonResponse
    {
        return $this->iLibDepartmentRosterCrudRepo->store($request);
    }

    /**
     * Index page for view
     *
     * @param integer|string $id
     * @param Request $request
     * @return view
     */
    public function edit($id,Request $request) : view
    {
        $data = $this->iLibDepartmentRosterCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.department.crud.roster.crud.index', compact('data'));
    }

    /**
     * Update procedure for libdepartmentroster
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iLibDepartmentRosterCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iLibDepartmentRosterCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iLibDepartmentRosterCrudRepo->updateList($request);
    }

}