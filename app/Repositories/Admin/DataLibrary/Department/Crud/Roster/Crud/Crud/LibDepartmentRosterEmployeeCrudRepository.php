<?php

namespace App\Repositories\Admin\DataLibrary\Department\Crud\Roster\Crud\Crud;

use App\Http\Requests\Admin\DataLibrary\Department\Crud\Roster\Crud\Crud\ValidateUpdateLibDepartmentRosterEmployee;
use App\Models\LibDepartmentRosterEmployee;
use App\Models\Employee;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Auth;
use DB;


class  LibDepartmentRosterEmployeeCrudRepository extends BaseRepository implements ILibDepartmentRosterEmployeeCrudRepository {

    use BaseTrait;
    public function __construct() {
        $this->LoadModels(['LibDepartmentRosterEmployee']);
    }

    /**
     * Get the page default resource
     *
     * @param Request $request
     * @param integer|string $id
     * @return array
     */
  
    public function index($request, $id = null): array
    {
        $where = ($id == null)
            ? [['lib_department_rosters_id', '=', $request->lib_department_rosters_id]]
            : [];

        $data = $this->getPageDefault(
            model: $this->LibDepartmentRosterEmployee,
            id: $id,
            where: $where
        );

        // REQUIRED FOR ADD / EDIT BLADE
        $data['employees'] = Employee::select('id', 'name')
            ->orderBy('name')
            ->get();

        return $data;
    }

    /**
     * Yajra datatbale list resource
     *
     * @param Request $request
     * @return JsonResponse
     */

public function list($request, $rosterId): JsonResponse
{
    $query = LibDepartmentRosterEmployee::query()
        ->leftJoin(
            'employees',
            'employees.id',
            '=',
            'lib_department_roster_employees.lib_employees_id'
        )
        ->where(
            'lib_department_roster_employees.lib_department_rosters_id',
            $rosterId
        )
        ->select(
            'lib_department_roster_employees.id',
            'employees.name as employee_name',
            'lib_department_roster_employees.in_time',
            'lib_department_roster_employees.out_time',
            'lib_department_roster_employees.off_day',
            'lib_department_roster_employees.created_at'
        );

    return DataTables::of($query)->make(true);
}



    /**
     * Yajra datatbale list resource
     *
     * @param Request $request
     * @return JsonResponse
     */

    /**
     * Store resource
     *
     * @param Request  $request
     * @return JsonResponse
     */
    public function store($request) : JsonResponse
    {   
       // dd($request->all());
        DB::beginTransaction();
        try {
            LibDepartmentRosterEmployee::create([
                ...$request->all(),
                //'serial' => $this->facSrWc($this->LibDepartmentRosterEmployee)
            ]);
            $response['extraData'] = ['inflate' => pxLang($request->lang,'','common.action_success') ];
            $this->saveTractAction($this->getTrackData(title: "LibDepartmentRosterEmployee was created by ".$request?->auth?->name,request: $request));
            DB::commit();
            return $this->response(['type' => 'success', 'data' => $response]);
        } catch (\Exception $e) {
            DB::rollback();
            $this->saveError($this->getSystemError(['name' => 'LibDepartmentRosterEmployee_store_error']), $e);
            return $this->response(['type' => 'noUpdate', 'title' => pxLang($request->lang,'','common.server_wrong')]);
        }
    }

    /**
     * Update resource
     *
     * @param Requets $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update($request,$id) : JsonResponse
    {
        $row = LibDepartmentRosterEmployee::find($id);
        if(empty($row)){
            return  $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-danger">'.pxLang($request->lang,'','common.no_resourse').'</span>']);
        }
        $rowRef = [...$row->toArray()];
        $row->fill($request->all());
        if($row->isDirty()){
            $validator = Validator::make($request->all(), (new ValidateUpdateLibDepartmentRosterEmployee())->rules($request,$row));
            if ($validator->fails()) {
                return $this->response(['type' => 'validation','errors' => $validator->errors()]);
            }
            DB::beginTransaction();
            try {
                $row->save();
                $data['extraData'] = ["inflate" =>  pxLang($request->lang,'','common.action_success')];
                $this->saveTractAction($this->getTrackData(title: " LibDepartmentRosterEmployee ".$row?->name.' was updated by '.$request?->auth?->name,request: $request, row: $rowRef, type: 'to'));
                DB::commit();
                return $this->response(['type' => 'success','data' => $data]);
            } catch (\Exception $e) {
                DB::rollback();
                $this->saveError($this->getSystemError(['name'=>'LibDepartmentRosterEmployee_update_error']), $e);
                return $this->response(["type"=>"wrong","lang"=>"server_wrong"]);
            }
        } else {
            return $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-success">'.pxLang($request->lang,'','common.no_change').'</span>']);
        }
    }

    /**
     *  Bulk update list resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateList($request) : JsonResponse
    {
        $i = LibDepartmentRosterEmployee::whereIn('id',$request->ids)->select(['id','name'])->get();;
        $dirty = [];
        if (count($i) > 0) {
            foreach ($i as $key => $value) {
                //$value->serial = $request->serial[$value->id];
                if ($value->isDirty()) {
                    $dirty[$key] = "yes";
                }
            }
            if (count($dirty) > 0) {
                DB::beginTransaction();
                try {
                    foreach ($i as $key => $value) {
                        $value->save();
                    }
                    $data['extraData'] = [
                        "inflate" => pxLang($request->lang,'','common.action_update_success')
                    ];
                    $this->saveTractAction($this->getTrackData(title: "LibDepartmentRosterEmployee list was updated by ".$request?->auth?->name, request: $request));
                    DB::commit();
                    return $this->response(['type' => 'success','data' => $data]);
                } catch (\Exception $e) {
                    DB::rollback();
                    $this->saveError($this->getSystemError(['name' => 'LibDepartmentRosterEmployee_bulk_update_error']), $e);
                    return $this->response(['type' => 'wrong', 'lang' => 'server_wrong']);
                }
            } else {
                return $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-success"> '.pxLang($request->lang,'','common.no_change').'  </span>']);
            }

        } else {
            return $this->response(['type' => 'noUpdate', 'title' => pxLang($request->lang,'','common.went_wrong')]);
        }
    }

    /**
     * Bulk delete list resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteList($request) : JsonResponse
    {
        $errors = [];
        $i = LibDepartmentRosterEmployee::whereIn('id',$request->ids)->select(['id'])->get();
        if (count($i) > 0) {
            // $errors = $this->checkInUse([
            //     "rows" => $i,
            //     "search" => ["id","id"],
            //     "denined" => ["name","name"],
            //     "targetModel" => [$this->StudentAdmission,$this->ExamResult],
            //     "targetCol" => ["lib_category_id","lib_category_id"],
            //     "exists" => ["Class Category","Class Category"],
            //     "in" => ["Stduent Table","Result Table"]
            // ]);
            if (count($errors) > 0) {
                return $this->response(['type'=>'bigError','errors'=>$errors]);
            }
            DB::beginTransaction();
            try {
                foreach ($i as $key => $value) {
                    $value->delete();
                }
                $data['extraData'] = [
                    "inflate" => pxLang($request->lang,'','common.action_delete_success'),
                    "redirect" => null
                ];
                $this->saveTractAction($this->getTrackData(title: "LibDepartmentRosterEmployee list was deleted by ".$request?->auth?->name, request: $request));
                DB::commit();
                return $this->response(['type' => 'success',"data"=>$data]);
            } catch (\Exception $e) {
                DB::rollback();
                $this->saveError($this->getSystemError(['name' => 'LibDepartmentRosterEmployee_store_error']), $e);
                return $this->response(['type' => 'wrong', 'lang' => 'server_wrong']);
            }
        } else {
            return $this->response(['type' => 'noUpdate', 'title' =>  pxLang($request->lang,'','common.no_data_selected')]);
        }
    }

}