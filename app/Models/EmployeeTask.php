<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class EmployeeTask extends Model
{
    use BaseTrait;
    protected $table = "employee_tasks";
    protected $fillable = [
        'name',
        'serial',
        'short_description',
        'long_description'
    ];
    //vpx_attach
}
