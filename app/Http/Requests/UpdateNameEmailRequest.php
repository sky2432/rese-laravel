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
    public static function rules($request, $id)
    {
        return [
            $request->validate([
            'name' => ['required','min:2'],
            'email' => ['required','email:rfc,dns',Rule::unique('users')->ignore($id)]
            ])
        ];
    }
}
