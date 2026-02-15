<?php

namespace App\Repositories\Admin\DataLibrary\Department\Crud\Roster\Modify\Load\AddRosterEmployee;

use Illuminate\Http\JsonResponse;

interface IAddRosterEmployeeLoadRepository
{

    public function index($request): array;
    public function display($request): array;
    public function store($request): array;
}
