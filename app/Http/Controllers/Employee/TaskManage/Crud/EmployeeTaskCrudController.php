<?php

namespace App\Http\Controllers\Employee\TaskManage\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\TaskManage\Crud\ValidateStoreEmployeeTask;
use App\Repositories\Employee\TaskManage\Crud\IEmployeeTaskCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class EmployeeTaskCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private IEmployeeTaskCrudRepository $iEmployeeTaskCrudRepo) {
        $this->middleware(['auth:employee','HasEmployeePassword','HasEmployeeAuth']);
        $this->lang= 'employee.task-manage.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for employeetask crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iEmployeeTaskCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('employee.pages.task-manage.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for employeetask crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iEmployeeTaskCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreEmployeeTask $request
     * @return JsonResponse
     */
    public function store(ValidateStoreEmployeeTask $request): JsonResponse
    {
        return $this->iEmployeeTaskCrudRepo->store($request);
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
        $data = $this->iEmployeeTaskCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('employee.pages.task-manage.crud.index', compact('data'));
    }

    /**
     * Update procedure for employeetask
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iEmployeeTaskCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iEmployeeTaskCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iEmployeeTaskCrudRepo->updateList($request);
    }

}