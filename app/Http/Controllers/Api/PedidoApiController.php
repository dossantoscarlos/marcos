<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PedidoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $pedidos = Pedido::all();

        return response()->json($pedidos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'cliente_id' => 'nullable|integer|exists:clientes,id',
            'produto_id' => 'nullable|integer|exists:produtos,id',
            'codigo_pedido' => 'required|string|max:255',
            'situacao' => 'nullable|string|max:255',
            'extras' => 'nullable|json',
        ]);

        $pedido = Pedido::create($validated);

        return response()->json($pedido, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido): JsonResponse
    {
        return response()->json($pedido);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido): JsonResponse
    {
        $validated = $request->validate([
            'cliente_id' => 'sometimes|nullable|integer|exists:clientes,id',
            'produto_id' => 'sometimes|nullable|integer|exists:produtos,id',
            'codigo_pedido' => 'sometimes|required|string|max:255',
            'situacao' => 'sometimes|nullable|string|max:255',
            'extras' => 'sometimes|nullable|json',
        ]);

        $pedido->update($validated);

        return response()->json($pedido);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido): JsonResponse
    {
        $pedido->delete();

        return response()->json(null, 204);
    }
}
