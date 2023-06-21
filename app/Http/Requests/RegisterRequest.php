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
            'email'         => 'required|unique:users',
            'password'       => 'required',
            'name'        => 'required|unique:users',
            'phone_num'         => 'required',
            'logo'         => 'required',
            'image1'         => 'required',
            'address'         => 'required',
            'description'         => 'required',
            'type'         => 'required',
            'image2'         => 'nullable',
            'image3'         => 'nullable',
            'image4'         => 'nullable',
            'image5'         => 'nullable',
            'options'         => 'array',
        ];
    }

    public function messages()
    {
        return [
            'email.required'          => 'email is required',
            'email.unique'          => 'email is unique',
            'password.required'       => 'password is required',
            'name.required'        => 'name is required',
            'name.unique'        => 'name is unique',
            'phone_num.required'         => 'phone_num is required',
            'logo.required'         => 'logo is required',
            'image1.required'         => 'image1 is required',
            'address.required'         => 'address is required',
            'description.required'         => 'description is required',
            'type.required'         => 'type is required',
            'image2.nullable'         => 'image2 is nullable',
            'image3.nullable'         => 'image3 is nullable',
            'image4.nullable'         => 'image4 is nullable',
            'image5.nullable'         => 'image5 is nullable',
            'options.array'         => 'options is array',
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
