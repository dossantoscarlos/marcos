<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePrecoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'produto_id' => ['required', 'integer', 'exists:produtos,id'],
            'desconto_id' => ['nullable', 'integer', 'exists:descontos,id'],
            'preco' => ['required', 'numeric', 'min:0'],
            'medida' => ['nullable', 'string', 'max:255'],
            'situacao' => ['nullable', 'string', 'max:255'],
        ];
    }
}
