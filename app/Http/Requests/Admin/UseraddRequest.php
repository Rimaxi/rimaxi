<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UseraddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:25',
            'email' => 'required',
            'dob' => 'before:' . date('Y-m-d'),
            'phone' => 'required|digits:10|numeric',
            'hobbies' => 'required|exists:hobbies,id',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',

        ];
    }
}
