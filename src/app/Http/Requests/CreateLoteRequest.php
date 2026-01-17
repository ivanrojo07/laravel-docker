<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateLoteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $lote_id = $this->route('lote');
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('lotes','name')->ignore($lote_id)
            ],
            'address' => [
                'required',
                'string'
            ]
        ];
    }
}
