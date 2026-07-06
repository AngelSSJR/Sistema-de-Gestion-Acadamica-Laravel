<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'code' => ['required', 'string', 'max:20', 'unique:rooms,code'],
            'capacity' => ['nullable', 'integer', 'min:1', 'max:500'],
            'resources' => ['nullable', 'string', 'max:500'],
            'is_active' => ['boolean'],
        ];
    }
}
