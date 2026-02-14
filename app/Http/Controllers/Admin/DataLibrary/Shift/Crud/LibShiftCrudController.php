<?php

namespace App\Http\Controllers\Admin\DataLibrary\Shift\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\Shift\Crud\ValidateStoreLibShift;
use App\Repositories\Admin\DataLibrary\Shift\Crud\ILibShiftCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class LibShiftCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ILibShiftCrudRepository $iLibShiftCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.shift.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for libshift crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iLibShiftCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.shift.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for libshift crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iLibShiftCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreLibShift $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibShift $request): JsonResponse
    {
        return $this->iLibShiftCrudRepo->store($request);
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
        $data = $this->iLibShiftCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.shift.crud.index', compact('data'));
    }

    /**
     * Update procedure for libshift
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iLibShiftCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iLibShiftCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iLibShiftCrudRepo->updateList($request);
    }

}