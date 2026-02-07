<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class LibDepartmentRoster extends Model
{
    use BaseTrait;
    protected $table = "lib_department_rosters";
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'lib_department_id',
       
    ];
    //vpx_attach
}
