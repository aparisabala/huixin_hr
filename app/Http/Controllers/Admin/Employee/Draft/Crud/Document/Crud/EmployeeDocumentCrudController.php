<?php

namespace App\Http\Controllers\Admin\Employee\Draft\Crud\Document\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee\Draft\Crud\Document\Crud\ValidateStoreEmployeeDocument;
use App\Models\Employee;
use App\Models\LibDocument;
use App\Repositories\Admin\Employee\Draft\Crud\Document\Crud\IEmployeeDocumentCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeDocumentCrudController  extends Controller
{

    use BaseTrait;
    public function __construct(private IEmployeeDocumentCrudRepository $iEmployeeDocumentCrudRepo)
    {
        $this->middleware(['auth:admin', 'HasAdminUserPassword', 'HasAdminUserAuth', 'SetAdminLanguage']);
        $this->lang = 'admin.employee.draft.crud.document.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });
        $this->docs = LibDocument::select(['id', 'name'])->get();
    }

    /**
     * Index page for employeedocument crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $employee = Employee::where([['uuid', '=', $request->uuid]])->first();
        $request->merge(['employee_id' => $employee?->id]);
        $data = $this->iEmployeeDocumentCrudRepo->index($request);
        $data['lang'] = $this->lang;
        $data['docs'] = $this->docs;
        $data['employee'] = $employee;
        return view('admin.pages.employee.draft.crud.document.crud.index', compact('data'));
    }

    /**
     * List items for yajra datatable for employeedocument crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        return  $this->iEmployeeDocumentCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreEmployeeDocument $request
     * @return JsonResponse
     */
    public function store(ValidateStoreEmployeeDocument $request): JsonResponse
    {
        return $this->iEmployeeDocumentCrudRepo->store($request);
    }

    /**
     * Index page for view
     *
     * @param integer|string $id
     * @param Request $request
     * @return view
     */
    public function edit($id, Request $request): view
    {
        $data = $this->iEmployeeDocumentCrudRepo->index($request, $id);
        $data['lang'] = $this->lang;
        $data['employee'] = Employee::where([['id', '=', $data['item']?->employee_id]])->first();
        $data['docs'] = $this->docs;
        return view('admin.pages.employee.draft.crud.document.crud.index', compact('data'));
    }

    /**
     * Update procedure for employeedocument
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        return $this->iEmployeeDocumentCrudRepo->update($request, $id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteList(Request $request): JsonResponse
    {
        return $this->iEmployeeDocumentCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateList(Request $request): JsonResponse
    {
        return $this->iEmployeeDocumentCrudRepo->updateList($request);
    }
}
