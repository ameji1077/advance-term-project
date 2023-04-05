<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'date' => ['required','date','after:today'],
            'time' => ['required','date_format:H:i'],
            'num_of_users' => ['required','integer'],
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を入力してください',
            'date.date' => '日付形式で入力してください',
            'date.after' => '日付を明日以降に変更してください',
            'time.required' => '時刻を入力してください',
            'time.date_format' => '時刻の形式が違います',
            'num_of_users.required' => '人数を入力してください',
            'num_of_users.integer' => '数値形式で入力してください',
        ];
    }
}
