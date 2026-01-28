<?php

namespace App\Http\Requests\Admin\DataLibrary\Department\Crud;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class ValidateStoreLibDepartment extends FormRequest
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
    public function rules(Request $request): array
    {
        return [
            'name' => 'required|string|max:253|unique:lib_departments,name',
            'in_time' => ['required', 'date_format:h:i A'],
            'out_time' => [
                'required',
                'date_format:h:i A',
                function ($attribute, $value, $fail) use ($request) {
                    $inTime = Carbon::createFromFormat('h:i A', $request->in_time);
                    $outTime = Carbon::createFromFormat('h:i A', $value);
                    if ($outTime->lte($inTime)) {
                        $fail(pxLang($this->lang,'text.max_out_time'));
                    }
                },
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
