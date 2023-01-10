<?php

namespace App\Http\Requests\API\Course;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCourseRequest extends FormRequest
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
            'title' => 'required|unique:courses,title,'.$this->id,
            'content' => 'required|unique:courses,content,'.$this->id,
            'slug' => 'required|max:255|unique:courses,slug,'.$this->id,
            'thumbnail' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_course_id' => 'required|integer|exists:category_courses,id',
            'price' => 'required|integer',
            'status' => 'required|integer|between:0,1',
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
