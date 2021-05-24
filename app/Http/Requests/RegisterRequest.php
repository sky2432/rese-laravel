<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            $request->validate([
                    'name' => 'required|min:2',
                    'email' => ['required', 'email',"unique:{$table_name},email"],
                    'password' => 'required|min:4',
            ])
        ];
    }
}
