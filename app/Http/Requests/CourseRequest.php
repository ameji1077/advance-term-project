<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'course_name' => ['required','string'],
            'price' => ['required','numeric'],
        ];
    }

    public function messages()
    {
        return [
            'course_name.required' => 'コース名を入力してください',
            'course_name.string' => '文字列型で入力してください',
            'price.required' => '価格を入力してください',
            'price.numeric' => '数値型で入力してください',
        ];
    }
}
