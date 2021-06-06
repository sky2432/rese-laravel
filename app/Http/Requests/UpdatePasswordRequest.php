<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest
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
    public static function rules($request, $item)
    {
        $rules = [
            'password' => ['required',
                function ($attribute, $value, $fail) use ($item) {
                    if (!(Hash::check($value, $item->password))) {
                        return $fail('現在のパスワードを正しく入力してください');
                    }
                },
            ],
            'new_password' => 'required|min:4|regex:/^[0-9a-zA-Z]*$/',
        ];

        $messages = [
            'new_password.regex' => 'パスワードは半角英数字で入力してください'
        ];

        return $request->validate($rules, $messages);
    }
}
