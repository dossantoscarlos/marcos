<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromocaoRequest;
use App\Http\Requests\UpdatePromocaoRequest;
use App\Models\Promocao;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PromocaoController extends Controller
{
    public function index(): View
    {
        $promocoes = Promocao::query()->latest()->paginate(15);

        return view('promocoes.index', compact('promocoes'));
    }

    public function create(): View
    {
        return view('promocoes.create');
    }

    public function store(StorePromocaoRequest $request): RedirectResponse
    {
        Promocao::create([
            ...$request->validated(),
            'uuid' => (string) Str::uuid(),
        ]);

        return redirect()->route('promocoes.index')->with('success', 'Promoção criada com sucesso.');
    }

    public function show(Promocao $promocao): View
    {
        return view('promocoes.show', compact('promocao'));
    }

    public function edit(Promocao $promocao): View
    {
        return view('promocoes.edit', compact('promocao'));
    }

    public function update(UpdatePromocaoRequest $request, Promocao $promocao): RedirectResponse
    {
        $promocao->update($request->validated());

        return redirect()->route('promocoes.index')->with('success', 'Promoção atualizada com sucesso.');
    }

    public function destroy(Promocao $promocao): RedirectResponse
    {
        $promocao->delete();

        return redirect()->route('promocoes.index')->with('success', 'Promoção removida com sucesso.');
    }
}
