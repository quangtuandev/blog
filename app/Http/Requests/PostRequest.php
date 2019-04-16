<?php

namespace App\Http\Requests;


class PostRequest extends AbstractRequest
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
                    'title' => 'required|string',
                    'content' => 'required|string',
                    'description' => 'required|string',
                    'image' => 'nullable',
                    'categories'=>'required',
                    'tags'=>'nullable'
                ];
        }
    }
}
