<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Preco;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PrecoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $precos = Preco::all();

        return response()->json($precos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'produto_id' => 'required|integer|exists:produtos,id',
            'desconto_id' => 'nullable|integer|exists:descontos,id',
            'preco' => 'required|numeric|min:0',
            'medida' => 'nullable|string|max:255',
            'situacao' => 'nullable|string|max:255',
            'extras' => 'nullable|json',
        ]);

        $preco = Preco::create([
            ...$validated,
            'uuid' => (string) Str::uuid(),
        ]);

        return response()->json($preco, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Preco $preco): JsonResponse
    {
        return response()->json($preco);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Preco $preco): JsonResponse
    {
        $validated = $request->validate([
            'produto_id' => 'sometimes|required|integer|exists:produtos,id',
            'desconto_id' => 'sometimes|nullable|integer|exists:descontos,id',
            'preco' => 'sometimes|required|numeric|min:0',
            'medida' => 'sometimes|nullable|string|max:255',
            'situacao' => 'sometimes|nullable|string|max:255',
            'extras' => 'sometimes|nullable|json',
        ]);

        $preco->update($validated);

        return response()->json($preco);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Preco $preco): JsonResponse
    {
        $preco->delete();

        return response()->json(null, 204);
    }
}
