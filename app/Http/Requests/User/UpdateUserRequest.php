<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore($this->route('user'))
            ],
            'avatar' => 'file',
            'department' => 'nullable|exists:departments,slug',
            'position' => 'required|exists:positions,id',
            'parent' => 'nullable|exists:positions,id',
            'password' => 'nullable|string|min:6|max:20|confirmed',
            'password_confirmation' => 'nullable|string|min:6|max:20',
        ];
    }
}
