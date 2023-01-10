<?php

namespace App\Http\Requests\API\VideoCourse;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateVideoCourseRequest extends FormRequest
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
            'title' => 'required|unique:course_episodes,title,'.$this->id,
            'content' => 'required|unique:course_episodes,content,'.$this->id,
            'episodes' => 'required|integer',
            'video' => 'required|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040',
            'course_id' => 'required|integer|exists:courses,id',
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
