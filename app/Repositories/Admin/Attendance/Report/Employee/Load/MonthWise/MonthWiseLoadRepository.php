<?php

namespace App\Repositories\Admin\Attendance\Report\Employee\Load\MonthWise;

use App\Models\Employee;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class MonthWiseLoadRepository extends BaseRepository implements IMonthWiseLoadRepository {

    use BaseTrait;
    public function __construct() {
    }

    /**
     * Get the page default resource
     *
     * @param Request $request
     * @param integer|string $id
     * @return array
     */
    public function index($request) : array
    {
       return [];
    }


    /**
     * Load view data
     *
     * @param Request $request
     * @return array
     */
    public function display($request) : array
    {
        $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
        $to_date = Carbon::parse($request->to_date)->format('Y-m-d');
        $data['from_date'] = Carbon::parse($from_date)->format('d M Y');
        $data['to_date'] = Carbon::parse($to_date)->format('d M Y');
        $data['item'] = Employee::with(['attendances' => function($q)use($from_date,$to_date) {
            $q->where([['att_date','>=',$from_date],['att_date','<=',$to_date]])->select(['id','employee_id','att_date','in_time','out_time']);
        }])->select(['id','name','employee_id','in_time','out_time'])->find($request->employee_id);
        $data['dates'] = $this->createPriod($from_date,$to_date, $data['item']);
        $data['lastSevenDays'] = [];
        for ($i = 6; $i >= 0; $i--) {
           $data['lastSevenDays'][]  = Carbon::now()->subDays($i)->format('Y-m-d');
        }
        $lates = array_filter($data['dates'],function($item){ return $item['late'] != 'no'; });
        $data['lateCount'] = count($lates);
        $data['totalLateHours'] = $this->calculateTotalLate($lates);
        return $data;
    }

    /**
     * Return attendance date
     *
     * @param Date $from_date
     * @param Date $to_date
     * @return array
     */
    private function createPriod($from_date,$to_date,$emp=null) : array
    {
        $period = CarbonPeriod::create($from_date, $to_date);
        $dates = [];
        foreach ($period as $date) {
            $att_date = $date->format('Y-m-d');
            $att = $emp?->attendances?->where('att_date',$att_date)->first();
            $dates[] = [
                'id' => $att?->id,
                'view' => $date->format('d M')." (".$date->format('D').")",
                'att_date' => $att_date,
                'has' => ($att == null) ? false : true,
                'in_time' =>  ($att != null &&  $att?->in_time != null) ? Carbon::parse($att?->in_time)->format('h:i A') : '-',
                'out_time' =>  ($att != null &&  $att?->out_time != null) ? Carbon::parse($att?->out_time)->format('h:i A') : '-',
                'working' => $this->totalWorkingHours($att),
                'late' => ($att != null &&  $att?->in_time != null && Carbon::parse($att?->in_time) > Carbon::parse($emp?->in_time)) ? $this->totalHour($emp?->in_time, $att?->in_time): 'no' ,
            ];
        }
        return $dates;
    }

    /**
     * Get total workign hours
     *
     * @param Time $att
     * @return string
     */
    private function totalWorkingHours($att) : string
    {
        if ($att && $att?->in_time && $att?->out_time) {
            return $this->totalHour($att?->in_time, $att?->out_time);
        } else {
            $total_work = '-';
        }
        return $total_work;
    }

    /**
     * Calculate intime out time according to given time
     *
     * @param string $in_time
     * @param string $out_time
     * @return string
     */
    private function totalHour($in_time,$out_time) : string
    {
        $in  = Carbon::parse($in_time);
        $out = Carbon::parse($out_time);
        $diffInMinutes = $in->diffInMinutes($out);
        $hours = floor($diffInMinutes / 60);
        $minutes = $diffInMinutes % 60;
        return sprintf('%02dh %02dm', $hours, $minutes);
    }

    private function calculateTotalLate($records)
    {
        $totalMinutes = 0;
        foreach ($records as $record) {
            if (!empty($record['late']) && $record['late'] !== '-') {
                if (preg_match('/(\d+)h\s*(\d+)m/', $record['late'], $matches)) {
                    $hours = (int)$matches[1];
                    $minutes = (int)$matches[2];
                    $totalMinutes += ($hours * 60) + $minutes;
                }
            }
        }
        $totalHours = floor($totalMinutes / 60);
        $remainingMinutes = $totalMinutes % 60;
        return sprintf("%02dh %02dm", $totalHours, $remainingMinutes);
    }
}
