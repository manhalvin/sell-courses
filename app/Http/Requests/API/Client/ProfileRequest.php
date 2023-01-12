<?php

namespace App\Http\Requests\API\Client;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:users,name,'.Auth::id(),
            'username' => 'required|unique:users,username,'.Auth::id(),
            'email' => 'required|email|unique:users,email,'.Auth::id(),
            'thumbnail' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'mobile_no' => 'required|regex:/(0)[0-9]{9}/',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validate Failed !',
            'data' => $validator->errors(),
        ]));
    }
}
