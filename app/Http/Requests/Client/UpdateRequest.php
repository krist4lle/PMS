<?php

namespace App\Http\Requests\Client;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
                Rule::unique('clients')->ignore($this->route('client')),
            ],
            'description' => 'required|string',
            'email' => [
                'required',
                'string',
                Rule::unique('clients')->ignore($this->route('client')),
            ],
            'phone' => [
                'required',
                'integer',
                'digits:12',
                Rule::unique('clients')->ignore($this->route('client')),
            ],
        ];
    }
}
