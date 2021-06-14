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
            'name' => 'required|max:10',
            'genre_id' => 'required|numeric',
            'overview' => 'required|max:255',
            'postal_code' => 'required|size:7',
            'main_address' => 'required|max:255',
            'option_address' => 'max:255'
        ];
    }
}
