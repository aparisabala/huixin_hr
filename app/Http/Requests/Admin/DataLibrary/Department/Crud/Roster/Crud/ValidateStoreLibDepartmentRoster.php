<?php

namespace App\Http\Requests\Admin\DataLibrary\Department\Crud\Roster\Crud;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class ValidateStoreLibDepartmentRoster extends FormRequest
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
    public function rules(): array
    {
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth   = Carbon::now()->endOfMonth()->toDateString();

        return [
            'name' => 'required|string|max:253',
            'lib_department_id' => 'required|exists:lib_departments,id',
            'start_date' => [
                'required',
                'date',
                "after_or_equal:$startOfMonth",
                "before_or_equal:$endOfMonth",
            ],
            'end_date' => [
                'required',
                'date',
                'after:start_date',
                "before_or_equal:$endOfMonth",
            ],
        ];
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
