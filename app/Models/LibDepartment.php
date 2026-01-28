<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class LibDepartment extends Model
{
    use BaseTrait;
    protected $table = "lib_departments";
    protected $fillable = [
        'name',
        'in_time',
        'out_time'
    ];
    //vpx_attach
}
