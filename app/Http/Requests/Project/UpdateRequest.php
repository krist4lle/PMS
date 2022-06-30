<?php

namespace App\Http\Requests\Project;

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
                Rule::unique('projects')->ignore($this->route('project')),
            ],
            'description' => 'required|string',
            'client' => 'exists:clients,id',
            'manager' => 'exists:users,id',
            'workers' => 'required|array',
            'workers.*' => 'required|exists:users,id',
            'deadline' => 'nullable|date',
        ];
    }
}
