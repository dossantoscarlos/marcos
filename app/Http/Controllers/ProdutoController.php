<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Models\Produto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProdutoController extends Controller
{
    public function index(): View
    {
        $produtos = Produto::query()->latest()->paginate(15);

        return view('produtos.index', compact('produtos'));
    }

    public function create(): View
    {
        return view('produtos.create');
    }

    public function store(StoreProdutoRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Produto::create([
            ...$validated,
            'uuid' => (string) Str::uuid(),
            'slug' => Str::slug($validated['nome']),
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso.');
    }

    public function show(Produto $produto): View
    {
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto): View
    {
        return view('produtos.edit', compact('produto'));
    }

    public function update(UpdateProdutoRequest $request, Produto $produto): RedirectResponse
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['nome']);

        $produto->update($validated);

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy(Produto $produto): RedirectResponse
    {
        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto removido com sucesso.');
    }
}
