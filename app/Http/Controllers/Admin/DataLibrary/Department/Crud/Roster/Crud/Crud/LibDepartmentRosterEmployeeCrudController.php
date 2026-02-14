<?php

namespace App\Http\Controllers\Admin\DataLibrary\Department\Crud\Roster\Crud\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\Department\Crud\Roster\Crud\Crud\ValidateStoreLibDepartmentRosterEmployee;
use App\Repositories\Admin\DataLibrary\Department\Crud\Roster\Crud\Crud\ILibDepartmentRosterEmployeeCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class LibDepartmentRosterEmployeeCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ILibDepartmentRosterEmployeeCrudRepository $iLibDepartmentRosterEmployeeCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.department.crud.roster.crud.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for libdepartmentrosteremployee crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request, $lib_department_rosters_id): View
    {
        $data = $this->iLibDepartmentRosterEmployeeCrudRepo->index($request);
        $data['lang'] = $this->lang;
        $data['lib_department_rosters_id'] = $request->lib_department_rosters_id;
        return view(
            'admin.pages.data-library.department.crud.roster.crud.crud.index',
            compact('data')
        );
    }



    /**
     * List items for yajra datatable for libdepartmentrosteremployee crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    // DATATABLE JSON
    public function list(Request $request, $lib_department_rosters_id): JsonResponse
    {
       return $this->iLibDepartmentRosterEmployeeCrudRepo
       ->list($request, $lib_department_rosters_id);
    }




    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreLibDepartmentRosterEmployee $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibDepartmentRosterEmployee $request): JsonResponse
    {
        return $this->iLibDepartmentRosterEmployeeCrudRepo->store($request);
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
        $data = $this->iLibDepartmentRosterEmployeeCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;

        $data['lib_department_rosters_id'] = $request->lib_department_rosters_id;

        // ✅ ADD THIS
        $data['employees'] = $this->iLibDepartmentRosterEmployeeCrudRepo->employees();

        return view(
            'admin.pages.data-library.department.crud.roster.crud.crud.index',
            compact('data')
        );
    }


    /**
     * Update procedure for libdepartmentrosteremployee
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iLibDepartmentRosterEmployeeCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iLibDepartmentRosterEmployeeCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iLibDepartmentRosterEmployeeCrudRepo->updateList($request);
    }

}