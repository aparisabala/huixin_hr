<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class EmployeeDocument extends Model
{
    use BaseTrait;
    protected $table = "employee_documents";
    protected $fillable = [
        'name',
        'serial',
        'doc',
        'employee_id',
        'lib_document_id'
    ];
    //vpx_attach

    public function libDoc()
    {
        return $this->hasOne(LibDocument::class,'id','lib_document_id');
    }
}
