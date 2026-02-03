<?php

namespace App\Repositories\Admin\Employee\Active\Dt\ActiveEmployee\Modal\UserSetting;

use App\Http\Requests\Admin\Employee\Active\Modal\ValidateUpdateEmployeeSetting;
use App\Models\Employee;
use App\Repositories\BaseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use DB;

class UserSettingRepository extends BaseRepository implements IUserSettingRepository
{

    /**
     * Modal  data
     *
     * @param Request $request
     * @return array
     */
    public function display($request): array
    {
        $data['item'] = Employee::find($request->id);
        return $data;
    }

    /**
     * Update resource
     *
     * @param Requets $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update($request): JsonResponse
    {
        $row = Employee::find($request->id);
        if (empty($row)) {
            return  $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-danger">' . pxLang($request->lang, '', 'common.no_resourse') . '</span>']);
        }
        $rowRef = [...$row->toArray()];
        $row->fill($request->all());
        if ($row->isDirty()) {
            $validator = Validator::make($request->all(), (new ValidateUpdateEmployeeSetting())->rules($request, $row));
            if ($validator->fails()) {
                return $this->response(['type' => 'validation', 'errors' => $validator->errors()]);
            }
            DB::beginTransaction();
            try {
                $row->save();
                $data['extraData'] = ["inflate" =>  pxLang($request->lang, '', 'common.action_success')];
                $this->saveTractAction($this->getTrackData(title: " LibBank " . $row?->name . ' was updated by ' . $request?->auth?->name, request: $request, row: $rowRef, type: 'to'));
                DB::commit();
                return $this->response(['type' => 'success', 'data' => $data]);
            } catch (\Exception $e) {
                DB::rollback();
                $this->saveError($this->getSystemError(['name' => 'LibBank_update_error']), $e);
                return $this->response(["type" => "wrong", "lang" => "server_wrong"]);
            }
        } else {
            return $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-success">' . pxLang($request->lang, '', 'common.no_change') . '</span>']);
        }
    }
}
