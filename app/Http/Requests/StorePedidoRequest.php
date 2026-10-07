<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest
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
            'cliente_id' => ['nullable', 'integer', 'exists:clientes,id'],
            'produto_id' => ['nullable', 'integer', 'exists:produtos,id'],
            'codigo_pedido' => ['required', 'string', 'max:255'],
            'situacao' => ['nullable', 'string', 'max:255'],
        ];
    }
}
