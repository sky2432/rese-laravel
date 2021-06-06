<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
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
    public static function rules($request, $item, $table_name)
    {
        $rules = [
            'email' => ['required','email',"exists:{$table_name}",
            ],
            'password' => ['required',
                function ($attribute, $value, $fail) use ($item) {
                    if ($item && !(Hash::check($value, $item->password))) {
                        return $fail('パスワードが間違っています。');
                    }
                },
                'regex:/^[0-9a-zA-Z]*$/'
            ]
        ];

        $messages = [
            'password.regex' => 'パスワードは半角英数字で入力してください'
        ];

        return $request->validate($rules, $messages);
    }
}
