<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|max:20|confirmed',
            'password_confirmation' => 'required|string|min:6|max:20',
            'gender' => 'required',
            'parent' => 'nullable|exists:positions,id',
            'department' => 'nullable|exists:departments,slug',
            'position' => 'required|exists:positions,id',
        ];
    }
}
