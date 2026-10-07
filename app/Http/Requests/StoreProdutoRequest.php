<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProdutoRequest extends FormRequest
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
            'nome' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:255', 'unique:produtos,sku'],
            'descricao' => ['required', 'string'],
            'preco' => ['required', 'numeric', 'min:0'],
            'imagem' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'max:255'],
            'subcategoria' => ['required', 'string', 'max:255'],
            'marca' => ['required', 'string', 'max:255'],
            'modelo' => ['required', 'string', 'max:255'],
            'cor' => ['required', 'string', 'max:255'],
            'tamanho' => ['required', 'string', 'max:255'],
            'material' => ['required', 'string', 'max:255'],
            'tipo' => ['required', 'string', 'max:255'],
            'estilo' => ['nullable', 'string', 'max:255'],
            'genero' => ['nullable', 'string', 'max:255'],
            'idade' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'in:ativo,inativo'],
            'tags' => ['nullable', 'string', 'max:255'],
        ];
    }
}
