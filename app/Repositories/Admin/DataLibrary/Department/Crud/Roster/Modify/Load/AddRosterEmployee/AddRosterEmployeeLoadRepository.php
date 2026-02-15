<?php

namespace App\Repositories\Admin\DataLibrary\Department\Crud\Roster\Modify\Load\AddRosterEmployee;

use App\Models\Employee;
use App\Models\LibDepartmentRoster;
use App\Models\LibShift;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Carbon\CarbonPeriod;

class AddRosterEmployeeLoadRepository extends BaseRepository implements IAddRosterEmployeeLoadRepository
{

    use BaseTrait;
    public function __construct()
    {
    }

    /**
     * Get the page default resource
     *
     * @param Request $request
     * @param integer|string $id
     * @return array
     */
    public function index($request): array
    {
        $rosterId = $request->route('lib_department_roster_id');
        $roster = LibDepartmentRoster::findOrFail($rosterId);
        $employees = Employee::where('lib_department_id', $roster->lib_department_id)->get();

        return [
            'roster' => $roster,
            'employees' => $employees,
        ];
    }


    /**
     * Load view data
     *
     * @param Request $request
     * @return array
     */
    public function display($request): array
    {
        $rosterId = $request->input('lib_department_roster_id');
        $roster = LibDepartmentRoster::findOrFail($rosterId);
        $employeeId = $request->input('employee_id');
        $employee = Employee::findOrFail($employeeId);

        $shifts = LibShift::all();

        $existingEntries = \DB::table('lib_department_roster_employees')
            ->where('lib_department_rosters_id', $rosterId)
            ->where('lib_employees_id', $employeeId)
            ->get()
            ->keyBy('date');

        $period = CarbonPeriod::create($roster->start_date, $roster->end_date);
        $dates = [];
        foreach ($period as $date) {
            $dateStr = $date->format('Y-m-d');
            $existing = $existingEntries->get($dateStr);
            $dates[] = [
                'date' => $dateStr,
                'day_name' => $date->format('l'),
                'is_off_day' => $existing ? $existing->off_day : 0,
                'shift_id' => $existing ? $existing->lib_company_shifts_id : null,
            ];
        }

        $data['employee'] = $employee;
        $data['roster'] = $roster;
        $data['dates'] = $dates;
        $data['shifts'] = $shifts;
        return $data;
    }

    /**
     * Store roster employee data
     *
     * @param Request $request
     * @return array
     */
    public function store($request): array
    {
        $rosterId = $request->input('lib_department_roster_id');
        $roster = LibDepartmentRoster::findOrFail($rosterId);
        $employeeId = $request->input('employee_id');
        $employee = Employee::findOrFail($employeeId);
        $shifts = $request->input('shifts', []);
        $offDays = $request->input('off_days', []);

        $period = CarbonPeriod::create($roster->start_date, $roster->end_date);

        foreach ($period as $date) {
            $dateStr = $date->format('Y-m-d');
            \DB::table('lib_department_roster_employees')->updateOrInsert(
                [
                    'lib_department_rosters_id' => $rosterId,
                    'lib_employees_id' => $employeeId,
                    'date' => $dateStr,
                ],
                [
                    'lib_company_shifts_id' => $shifts[$dateStr] ?? null,
                    'off_day' => in_array($dateStr, $offDays ?? []) ? 1 : 0,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }

        return [];
    }
}