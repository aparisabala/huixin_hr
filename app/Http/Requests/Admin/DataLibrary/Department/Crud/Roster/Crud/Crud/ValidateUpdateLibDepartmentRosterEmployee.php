<?php

namespace App\Http\Requests\Admin\DataLibrary\Department\Crud\Roster\Crud\Crud;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ValidateUpdateLibDepartmentRosterEmployee extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [];
    }

    public function rules($request, $row): array
    {
        $rules = [];

        if ($row->isDirty('lib_employees_id')) {
            $rules['lib_employees_id'] = 'required|exists:employees,id';
        }

        if ($row->isDirty('in_time')) {
            $rules['in_time'] = 'required|date_format:h:i A';
        }

        if ($row->isDirty('out_time')) {
            $rules['out_time'] = 'required|date_format:h:i A|after:in_time';
        }

        if ($row->isDirty('off_day')) {
            $rules['off_day'] = 'nullable|boolean';
        }

        return $rules;
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
