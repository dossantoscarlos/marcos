<?php

// Deprecated - use ClienteApiController instead

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClienteApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $clientes = Cliente::all();

        return response()->json($clientes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string|max:50',
            'endereco' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:100',
            'estado' => 'nullable|string|max:100',
            'cep' => 'nullable|string|max:20',
            'status' => 'nullable|in:ativo,inativo',
            'extras' => 'nullable|json',
        ]);
        $cliente = Cliente::create([
            ...$validated,
            'uuid' => (string) Str::uuid(),
        ]);

        return response()->json($cliente, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente): JsonResponse
    {
        return response()->json($cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente): JsonResponse
    {
        $validated = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|nullable|email',
            'telefone' => 'sometimes|nullable|string|max:50',
            'endereco' => 'sometimes|nullable|string|max:255',
            'cidade' => 'sometimes|nullable|string|max:100',
            'estado' => 'sometimes|nullable|string|max:100',
            'cep' => 'sometimes|nullable|string|max:20',
            'status' => 'sometimes|nullable|in:ativo,inativo',
            'extras' => 'sometimes|nullable|json',
        ]);
        $cliente->update($validated);

        return response()->json($cliente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente): JsonResponse
    {
        $cliente->delete();

        return response()->json(null, 204);
    }
}
