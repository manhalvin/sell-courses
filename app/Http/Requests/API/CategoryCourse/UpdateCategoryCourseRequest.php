<?php

namespace App\Http\Requests\API\CategoryCourse;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCategoryCourseRequest extends FormRequest
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
            'name' => 'required|unique:category_courses,name,'.$this->id,
            'slug' => 'required|max:255|unique:category_courses,slug,'.$this->id,
            'parent_id' => 'required|integer',
            'status' => 'required|integer|between:0,1',
            'thumbnail' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validate Failed !',
            'data'      => $validator->errors()
        ]));
    }
}
