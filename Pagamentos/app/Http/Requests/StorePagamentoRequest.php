<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePagamentoRequest extends FormRequest
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
            'cliente_id' => ['required', 'integer', 'exists:clientes,id'],
            'pedido_id' => ['required', 'integer', 'exists:pedidos,id'],
            'valor' => ['required', 'numeric', 'min:0'],
            'situacao' => ['nullable', 'string', 'max:255'],
            'observacoes' => ['nullable', 'string', 'max:255'],
            'data_estimada_pagamento' => ['nullable', 'string', 'max:255'],
            'data_evetiva_pagamento' => ['nullable', 'string', 'max:255'],
            'evidencia' => ['nullable', 'string', 'max:255'],
            'tipo' => ['nullable', 'string', 'max:255'],
        ];
    }
}
