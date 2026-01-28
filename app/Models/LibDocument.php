<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class LibDocument extends Model
{
    use BaseTrait;
    protected $table = "lib_documents";
    protected $fillable = [
        'name',
        //'serial'
    ];
    //vpx_attach
}
