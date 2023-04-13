<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
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
            'email' => ['required','string','email','unique:App\Models\AdminUser,email'],
            'password' => ['required','min:8'],
            'shop_level' => ['required','integer'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ユーザーネームを入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスの形式で入力してくだい',
            'email.unique' => '他のユーザーが既に使われているメールアドレスです',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードを8文字以上入力してください',
            'shop_level.required' => '店舗レベルを入力してください',
            'shop_level.integer' => '整数値で入力してください',
        ];
    }
}
