<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrecoRequest;
use App\Http\Requests\UpdatePrecoRequest;
use App\Models\Desconto;
use App\Models\Preco;
use App\Models\Produto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PrecoController extends Controller
{
    public function index(): View
    {
        $precos = Preco::query()->with(['produto', 'desconto'])->latest()->paginate(15);

        return view('precos.index', compact('precos'));
    }

    public function create(): View
    {
        return view('precos.create', $this->formOptions());
    }

    public function store(StorePrecoRequest $request): RedirectResponse
    {
        Preco::create([
            ...$request->validated(),
            'uuid' => (string) Str::uuid(),
        ]);

        return redirect()->route('precos.index')->with('success', 'Preço criado com sucesso.');
    }

    public function show(Preco $preco): View
    {
        $preco->load(['produto', 'desconto']);

        return view('precos.show', compact('preco'));
    }

    public function edit(Preco $preco): View
    {
        return view('precos.edit', [
            'preco' => $preco,
            ...$this->formOptions(),
        ]);
    }

    public function update(UpdatePrecoRequest $request, Preco $preco): RedirectResponse
    {
        $preco->update($request->validated());

        return redirect()->route('precos.index')->with('success', 'Preço atualizado com sucesso.');
    }

    public function destroy(Preco $preco): RedirectResponse
    {
        $preco->delete();

        return redirect()->route('precos.index')->with('success', 'Preço removido com sucesso.');
    }

    /**
     * @return array{produtos: Collection<int, Produto>, descontos: Collection<int, Desconto>}
     */
    private function formOptions(): array
    {
        return [
            'produtos' => Produto::query()->orderBy('nome')->get(['id', 'nome']),
            'descontos' => Desconto::query()->orderBy('nome')->get(['id', 'nome']),
        ];
    }
}
