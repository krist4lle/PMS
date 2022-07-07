<?php

namespace App\Http\Requests\Project;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|unique:projects,title',
            'description' => 'required|string',
            'client' => 'required|integer|exists:clients,id',
            'manager' => 'required|integer|exists:users,id',
            'workers' => 'required|array',
            'workers.*' => 'required|integer|exists:users,id',
            'deadline' => 'nullable|date',

        ];
    }
}
