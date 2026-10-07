<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Desconto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DescontoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $descontos = Desconto::all();

        return response()->json($descontos);
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
            'situacao' => 'nullable|string|max:255',
            'extras' => 'nullable|json',
        ]);

        $desconto = Desconto::create([
            ...$validated,
            'uuid' => (string) Str::uuid(),
        ]);

        return response()->json($desconto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Desconto $desconto): JsonResponse
    {
        return response()->json($desconto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Desconto $desconto): JsonResponse
    {
        $validated = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'descricao' => 'sometimes|nullable|string',
            'percentual' => 'sometimes|required|numeric|min:0|max:100',
            'situacao' => 'sometimes|nullable|string|max:255',
            'extras' => 'sometimes|nullable|json',
        ]);

        $desconto->update($validated);

        return response()->json($desconto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Desconto $desconto): JsonResponse
    {
        $desconto->delete();

        return response()->json(null, 204);
    }
}
