<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagamentoRequest;
use App\Http\Requests\UpdatePagamentoRequest;
use App\Models\Cliente;
use App\Models\Pagamento;
use App\Models\Pedido;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PagamentoController extends Controller
{
    public function index(): View
    {
        $pagamentos = Pagamento::query()->with(['cliente', 'pedido'])->latest()->paginate(15);

        return view('pagamentos.index', compact('pagamentos'));
    }

    public function create(): View
    {
        return view('pagamentos.create', $this->formOptions());
    }

    public function store(StorePagamentoRequest $request): RedirectResponse
    {
        Pagamento::create([
            ...$request->validated(),
            'uuid' => (string) Str::uuid(),
        ]);

        return redirect()->route('pagamentos.index')->with('success', 'Pagamento criado com sucesso.');
    }

    public function show(Pagamento $pagamento): View
    {
        $pagamento->load(['cliente', 'pedido']);

        return view('pagamentos.show', compact('pagamento'));
    }

    public function edit(Pagamento $pagamento): View
    {
        return view('pagamentos.edit', [
            'pagamento' => $pagamento,
            ...$this->formOptions(),
        ]);
    }

    public function update(UpdatePagamentoRequest $request, Pagamento $pagamento): RedirectResponse
    {
        $pagamento->update($request->validated());

        return redirect()->route('pagamentos.index')->with('success', 'Pagamento atualizado com sucesso.');
    }

    public function destroy(Pagamento $pagamento): RedirectResponse
    {
        $pagamento->update([
            'situacao' => 'cancelado',
        ]);
        $pagamento->delete();

        return redirect()->route('pagamentos.index')->with('success', 'Pagamento cancelado com sucesso.');
    }

    /**
     * @return array{clientes: Collection<int, Cliente>, pedidos: Collection<int, Pedido>}
     */
    private function formOptions(): array
    {
        return [
            'clientes' => Cliente::query()->orderBy('nome')->get(['id', 'nome']),
            'pedidos' => Pedido::query()->orderBy('codigo_pedido')->get(['id', 'codigo_pedido']),
        ];
    }
}
