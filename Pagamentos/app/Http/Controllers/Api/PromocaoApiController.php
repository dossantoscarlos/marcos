<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promocao;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PromocaoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $promocoes = Promocao::all();

        return response()->json($promocoes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'percentual' => 'required|numeric|min:0|max:100',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'situacao' => 'nullable|string|max:255',
            'extras' => 'nullable|json',
        ]);

        $promocao = Promocao::create([
            ...$validated,
            'uuid' => (string) Str::uuid(),
        ]);

        return response()->json($promocao, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Promocao $promocao): JsonResponse
    {
        return response()->json($promocao);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promocao $promocao): JsonResponse
    {
        $validated = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'descricao' => 'sometimes|nullable|string',
            'percentual' => 'sometimes|required|numeric|min:0|max:100',
            'data_inicio' => 'sometimes|required|date',
            'data_fim' => 'sometimes|required|date|after_or_equal:data_inicio',
            'situacao' => 'sometimes|nullable|string|max:255',
            'extras' => 'sometimes|nullable|json',
        ]);

        $promocao->update($validated);

        return response()->json($promocao);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promocao $promocao): JsonResponse
    {
        $promocao->delete();

        return response()->json(null, 204);
    }
}
