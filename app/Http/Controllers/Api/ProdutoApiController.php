<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProdutoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $produtos = Produto::all();

        return response()->json($produtos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:produtos,sku',
            'descricao' => 'required|string',
            'preco' => 'required|numeric|min:0',
            'imagem' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'subcategoria' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'tamanho' => 'required|string|max:255',
            'material' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'estilo' => 'nullable|string|max:255',
            'genero' => 'nullable|string|max:255',
            'idade' => 'nullable|string|max:255',
            'status' => 'nullable|in:ativo,inativo',
            'tags' => 'nullable|string|max:255',
            'extras' => 'nullable|json',
        ]);

        $produto = Produto::create([
            ...$validated,
            'uuid' => (string) Str::uuid(),
            'slug' => Str::slug($validated['nome']),
        ]);

        return response()->json($produto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto): JsonResponse
    {
        return response()->json($produto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto): JsonResponse
    {
        $validated = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'sku' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('produtos', 'sku')->ignore($produto)],
            'descricao' => 'sometimes|required|string',
            'preco' => 'sometimes|required|numeric|min:0',
            'imagem' => 'sometimes|required|string|max:255',
            'categoria' => 'sometimes|required|string|max:255',
            'subcategoria' => 'sometimes|required|string|max:255',
            'marca' => 'sometimes|required|string|max:255',
            'modelo' => 'sometimes|required|string|max:255',
            'cor' => 'sometimes|required|string|max:255',
            'tamanho' => 'sometimes|required|string|max:255',
            'material' => 'sometimes|required|string|max:255',
            'tipo' => 'sometimes|required|string|max:255',
            'estilo' => 'sometimes|nullable|string|max:255',
            'genero' => 'sometimes|nullable|string|max:255',
            'idade' => 'sometimes|nullable|string|max:255',
            'status' => 'sometimes|nullable|in:ativo,inativo',
            'tags' => 'sometimes|nullable|string|max:255',
            'extras' => 'sometimes|nullable|json',
        ]);

        if (isset($validated['nome'])) {
            $validated['slug'] = Str::slug($validated['nome']);
        }

        $produto->update($validated);

        return response()->json($produto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto): JsonResponse
    {
        $produto->delete();

        return response()->json(null, 204);
    }
}
