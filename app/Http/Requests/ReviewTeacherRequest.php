<?php

namespace App\Http\Requests;

class ReviewTeacherRequest extends AbstractRequest
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
        switch ($this->method()) {
            case 'PATCH':
            case 'PUT':
                return [

                ];
            default:
                return [
                    'title' => 'required',
                    'content' => 'nullable|string',
                    'star' => 'required|numeric|max:6',
                    'teacher_id' => 'required',
                ];
        }
    }
}
