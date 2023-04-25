<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'name' => ['required','string'],
            'area_id' => ['required','integer'],
            'genre_id' => ['required','integer'],
            'description' => ['required','string'],
            'image_url' => ['mimes:jpeg,jpg,png'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名を入力してください',
            'name.string' => '文字列型で入力してください',
            'area_id.required' => 'エリア名を入力してください',
            'area_id.integer' => '整数値で入力してください', 
            'genre_id.required' => 'ジャンル名を入力してください',
            'genre_id.integer' => '整数値で入力してください',
            'description.required' => '説明文を入力してください',
            'description.string' => '文字列型で入力してください',
            'image_url.mimes' => '.jpeg,.jpg,.pngのファイルを選択してください',
        ];
    }
}
