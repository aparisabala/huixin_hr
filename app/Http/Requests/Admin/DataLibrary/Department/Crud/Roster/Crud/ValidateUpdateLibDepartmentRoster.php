<?php

namespace App\Http\Requests\Admin\DataLibrary\Department\Crud\Roster\Crud;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class ValidateUpdateLibDepartmentRoster extends FormRequest
{
   /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function message() : array
    {
        return [
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules($request, $row): array
    {
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth   = Carbon::now()->endOfMonth()->toDateString();
        $rules = [];
        if ($row->isDirty('name')) {
            $rules['name'] = 'required|string|max:253';
        }
        if ($row->isDirty('start_date')) {
            $rules['start_date'] = [
                'required',
                'date',
                "after_or_equal:$startOfMonth",
                "before_or_equal:$endOfMonth",
            ];
        }
        if ($row->isDirty('end_date')) {
            $rules['end_date'] = [
                'required',
                'date',
                'after:start_date',
                "before_or_equal:$endOfMonth",
            ];
        }
        return $rules;
    }
     

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'errors'  => $validator->errors(),
        ]);
        throw (new ValidationException($validator, $response))->errorBag($this->errorBag);
    }
}
