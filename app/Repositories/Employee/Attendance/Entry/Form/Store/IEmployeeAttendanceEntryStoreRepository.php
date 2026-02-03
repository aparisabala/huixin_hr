<?php

namespace App\Repositories\Employee\Attendance\Entry\Form\Store;

use Illuminate\Http\JsonResponse;

interface IEmployeeAttendanceEntryStoreRepository
{

    public function index($request): array;
    public function store($request): JsonResponse;
    public function update($request): JsonResponse;
    public function bind($request): JsonResponse;
}
