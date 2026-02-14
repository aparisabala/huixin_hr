<?php

namespace App\Http\Requests\Admin\DataLibrary\Department\Crud\Roster\Crud\Crud;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ValidateStoreLibDepartmentRosterEmployee extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [];
    }

    public function rules(): array
    {
        return [
            'lib_department_rosters_id' => 'required|exists:lib_department_rosters,id',
            'lib_employees_id'          => 'required|exists:employees,id', // 🔴 FIX 2 also here

            'in_time'  => 'required|date_format:h:i A',
            'out_time' => 'required|date_format:h:i A|after:in_time',

            'off_day'  => 'nullable|boolean',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'errors'  => $validator->errors(),
        ]);
        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag);
    }
}
