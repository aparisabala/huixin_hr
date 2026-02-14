<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class LibDepartmentRosterEmployee extends Model
{
    use BaseTrait;
    protected $table = "lib_department_roster_employees";
    protected $fillable = [
        'lib_department_rosters_id',
        'lib_employees_id',
        'in_time',
        'out_time',
        'off_day',
        //'serial'
    ];
    //vpx_attach
}
