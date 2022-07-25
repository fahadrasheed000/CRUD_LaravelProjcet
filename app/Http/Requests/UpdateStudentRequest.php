<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'student_id' => 'required|max:20',
            'name' => 'required|max:100',
            'address' => 'required|max:255'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = response()->json($validator->errors(), 422);

        throw new HttpResponseException($errors);
    }
}
