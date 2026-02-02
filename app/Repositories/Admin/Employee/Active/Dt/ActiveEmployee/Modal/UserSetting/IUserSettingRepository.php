<?php

namespace App\Repositories\Admin\Employee\Active\Dt\ActiveEmployee\Modal\UserSetting;

use Illuminate\Http\JsonResponse;

interface IUserSettingRepository
{

    public function display($request): array;
    public function update($request): JsonResponse;
}
