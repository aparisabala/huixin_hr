<?php

namespace App\Http\Controllers\Admin\DataLibrary\Documents\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\Documents\Crud\ValidateStoreLibDocument;
use App\Repositories\Admin\DataLibrary\Documents\Crud\ILibDocumentCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LibDocumentCrudController  extends Controller
{

    use BaseTrait;
    public function __construct(private ILibDocumentCrudRepository $iLibDocumentCrudRepo)
    {
        $this->middleware(['auth:admin', 'HasAdminUserPassword', 'HasAdminUserAuth', 'SetAdminLanguage']);
        $this->lang = 'admin.data-library.documents.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });
    }

    /**
     * Index page for libdocument crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $data = $this->iLibDocumentCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.documents.crud.index', compact('data'));
    }

    /**
     * List items for yajra datatable for libdocument crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        return  $this->iLibDocumentCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreLibDocument $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibDocument $request): JsonResponse
    {
        return $this->iLibDocumentCrudRepo->store($request);
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
        $data = $this->iLibDocumentCrudRepo->index($request, $id);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.documents.crud.index', compact('data'));
    }

    /**
     * Update procedure for libdocument
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        return $this->iLibDocumentCrudRepo->update($request, $id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteList(Request $request): JsonResponse
    {
        return $this->iLibDocumentCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateList(Request $request): JsonResponse
    {
        return $this->iLibDocumentCrudRepo->updateList($request);
    }
}
