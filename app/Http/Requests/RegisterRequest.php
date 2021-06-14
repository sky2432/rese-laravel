<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class RegisterRequest extends FormRequest
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
    public static function rules($request, $table_name)
    {
        $rules = [
            'name' => 'required|min:2|max:10',
            'email' => ['required', 'email', 'max:255', "unique:{$table_name},email"],
            'password' => 'required|min:4|max:255|regex:/^[0-9a-zA-Z]*$/',
        ];

        $messages = [
            'password.regex' => 'パスワードは半角英数字で入力してください'
        ];

        return $request->validate($rules, $messages);
    }
}
