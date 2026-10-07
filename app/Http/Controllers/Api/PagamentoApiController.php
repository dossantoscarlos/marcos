<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pagamento;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PagamentoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $pagamentos = Pagamento::query()->withTrashed()->get();

        return response()->json($pagamentos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'cliente_id' => 'required|integer|exists:clientes,id',
            'pedido_id' => 'required|integer|exists:pedidos,id',
            'valor' => 'required|numeric|min:0',
            'situacao' => 'nullable|string|max:255',
            'observacoes' => 'nullable|string|max:255',
            'data_estimada_pagamento' => 'nullable|string|max:255',
            'data_evetiva_pagamento' => 'nullable|string|max:255',
            'evidencia' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'tipo' => 'nullable|string|max:255',
            'extras' => 'nullable|json',
        ]);

        if ($request->hasFile('evidencia')) {
            $path = $request->file('evidencia')->store('evidencias', 'public');
            $validated['evidencia'] = $path;
            $validated['situacao'] = 'pago';
        }

        $pagamento = Pagamento::create([
            ...$validated,
            'uuid' => (string) Str::uuid(),
        ]);

        return response()->json($pagamento, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pagamento $pagamento): JsonResponse
    {
        $pagamento->load([
            'cliente:id,nome',
            'pedido:id,codigo_pedido',
        ]);

        $payload = $pagamento->toArray();

        if ($pagamento->evidencia) {
            $payload['evidencia_url'] = route('storage.public', ['path' => $pagamento->evidencia]);
            $payload['evidencia_is_image'] = Str::of($pagamento->evidencia)
                ->lower()
                ->endsWith(['.jpg', '.jpeg', '.png', '.gif', '.webp', '.bmp', '.svg']);
        }

        return response()->json($payload);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pagamento $pagamento): JsonResponse
    {
        $validated = $request->validate([
            'cliente_id' => 'sometimes|required|integer|exists:clientes,id',
            'pedido_id' => 'sometimes|required|integer|exists:pedidos,id',
            'valor' => 'sometimes|required|numeric|min:0',
            'situacao' => 'sometimes|nullable|string|max:255',
            'observacoes' => 'sometimes|nullable|string|max:255',
            'data_estimada_pagamento' => 'sometimes|nullable|string|max:255',
            'data_evetiva_pagamento' => 'sometimes|nullable|string|max:255',
            'evidencia' => 'sometimes|nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'tipo' => 'sometimes|nullable|string|max:255',
            'extras' => 'sometimes|nullable|json',
        ]);

        if ($request->hasFile('evidencia')) {
            if ($pagamento->evidencia) {
                Storage::disk('public')->delete($pagamento->evidencia);
            }
            $validated['evidencia'] = $request->file('evidencia')->store('evidencias', 'public');
            $validated['situacao'] = 'pago';
        }

        $pagamento->update($validated);

        return response()->json($pagamento);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pagamento $pagamento): JsonResponse
    {
        if ($pagamento->trashed()) {
            $pagamento->forceDelete();

            return response()->json(null, 204);
        }

        if ($pagamento->situacao !== 'cancelado') {
            $pagamento->update([
                'situacao' => 'cancelado',
            ]);

            return response()->json(null, 204);
        }

        $pagamento->delete();

        return response()->json(null, 204);
    }
}
