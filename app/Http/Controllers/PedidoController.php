<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class PedidoController extends Controller
{
    public function index(): View
    {
        $pedidos = Pedido::query()->with(['cliente', 'produto'])->latest()->paginate(15);

        return view('pedidos.index', compact('pedidos'));
    }

    public function create(): View
    {
        return view('pedidos.create', $this->formOptions());
    }

    public function store(StorePedidoRequest $request): RedirectResponse
    {
        Pedido::create($request->validated());

        return redirect()->route('pedidos.index')->with('success', 'Pedido criado com sucesso.');
    }

    public function show(Pedido $pedido): View
    {
        $pedido->load(['cliente', 'produto']);

        return view('pedidos.show', compact('pedido'));
    }

    public function edit(Pedido $pedido): View
    {
        return view('pedidos.edit', [
            'pedido' => $pedido,
            ...$this->formOptions(),
        ]);
    }

    public function update(UpdatePedidoRequest $request, Pedido $pedido): RedirectResponse
    {
        $pedido->update($request->validated());

        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado com sucesso.');
    }

    public function destroy(Pedido $pedido): RedirectResponse
    {
        $pedido->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido removido com sucesso.');
    }

    /**
     * @return array{clientes: Collection<int, Cliente>, produtos: Collection<int, Produto>}
     */
    private function formOptions(): array
    {
        return [
            'clientes' => Cliente::query()->orderBy('nome')->get(['id', 'nome']),
            'produtos' => Produto::query()->orderBy('nome')->get(['id', 'nome']),
        ];
    }
}
