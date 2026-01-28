<?php

namespace App\Http\Controllers\Admin\Employee\Draft\Crud\Modal\ViewDraftEmployee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Traits\BaseTrait;
use Illuminate\Http\JsonResponse;
use View;
use Illuminate\Http\Request;
use App\Repositories\Admin\Employee\Draft\Crud\Modal\ViewDraftEmployee\IViewDraftEmployeeRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Response;
//vpx_imports

class ViewDraftEmployeeModalController extends Controller
{

    use BaseTrait;
    public function __construct(private IViewDraftEmployeeRepository $iViewDraftEmployeeRepo)
    {
        $this->middleware(['auth:admin', 'HasAdminUserPassword', 'HasAdminUserAuth', 'SetAdminLanguage']);
        $this->lang = 'admin.employee.draft.crud.modal.view-draft-employee';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });
    }

    /**
     * Loaded page for viewdraftemployee
     *
     * @param Request $request
     * @return View
     */
    public function display(Request $request): JsonResponse
    {
        $data['lang'] = $this->lang;
        $data = [...$data, ...$this->iViewDraftEmployeeRepo->display($request)];
        $view = View::make('admin.pages.employee.draft.crud.modal.view-draft-employee._modal', compact('data'))->render();
        $response = ['extraData' => ['inflate' => pxLang($data['lang'], '', 'common.response_success')], 'view' => $view];
        return $this->response(['type' => 'success', 'data' => $response]);
    }
    //vpx_attach

    public function entry(Request $request)
    {
        $messages = [];
        $rules = [
            'joining_date' => 'required|date_format:Y-m-d',
            'in_time' => ['required', 'date_format:h:i A'],
            'out_time' => [
                'required',
                'date_format:h:i A',
                function ($attribute, $value, $fail) use ($request) {
                    $inTime = Carbon::createFromFormat('h:i A', $request->in_time);
                    $outTime = Carbon::createFromFormat('h:i A', $value);
                    if ($outTime->lte($inTime)) {
                        $fail(pxLang($this->lang, 'text.max_out_time'));
                    }
                },
            ],
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Response::json(
                array(
                    'success' => false,
                    'errors'  => $validator->getMessageBag()->toArray(),
                )
            );
        }
        return $this->iViewDraftEmployeeRepo->entry($request);
    }
}
