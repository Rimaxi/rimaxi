<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'email' => 'required|unique:users,email',
            'dob' => 'before:' . date('Y-m-d'),
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => 'required|digits:10|numeric',
            'hobbies' => 'required|exists:hobbies,id',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'useraddress.*' => ['required', 'string'],
        ];
    }
    public function attributes(): array
    {
        return [
            'useraddress.*' => 'address',
        ];
    }
}
