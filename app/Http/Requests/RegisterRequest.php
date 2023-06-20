<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'title'         => 'required',
            'content'       => 'required',
            'status'        => 'required',
            'image'         => 'required',
            'user_id'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'          => 'title is required',
            'content.required'       => 'content is required',
            'status.required'        => 'status is required',
            'image.required'         => 'image is required',
            'user_id.required'       => 'user_id is required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([

            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ],400));
    }
}
