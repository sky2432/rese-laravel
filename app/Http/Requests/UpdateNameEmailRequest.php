<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNameEmailRequest extends FormRequest
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
    public static function rules($request, $id, $table_name, $item)
    {
        $rules = [
            'name' => ['required', 'min:2', 'max:10',
                function ($attribute, $value, $fail) use ($item) {
                    if ($value === $item->name) {
                     return $fail('現在と違う名前を入力してください');
                    }
                }],
            'email' => ['required', 'email', 'max:255', Rule::unique($table_name)->ignore($id),
                function ($attribute, $value, $fail) use ($item) {
                    if ($value === $item->email) {
                     return $fail('現在と違うメールアドレスを入力してください');
                    }
                }]
        ];

        return $request->validate($rules);
    }
}
