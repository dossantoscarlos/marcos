<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDescontoRequest;
use App\Http\Requests\UpdateDescontoRequest;
use App\Models\Desconto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DescontoController extends Controller
{
    public function index(): View
    {
        $descontos = Desconto::query()->latest()->paginate(15);

        return view('descontos.index', compact('descontos'));
    }

    public function create(): View
    {
        return view('descontos.create');
    }

    public function store(StoreDescontoRequest $request): RedirectResponse
    {
        Desconto::create([
            ...$request->validated(),
            'uuid' => (string) Str::uuid(),
        ]);

        return redirect()->route('descontos.index')->with('success', 'Desconto criado com sucesso.');
    }

    public function show(Desconto $desconto): View
    {
        return view('descontos.show', compact('desconto'));
    }

    public function edit(Desconto $desconto): View
    {
        return view('descontos.edit', compact('desconto'));
    }

    public function update(UpdateDescontoRequest $request, Desconto $desconto): RedirectResponse
    {
        $desconto->update($request->validated());

        return redirect()->route('descontos.index')->with('success', 'Desconto atualizado com sucesso.');
    }

    public function destroy(Desconto $desconto): RedirectResponse
    {
        $desconto->delete();

        return redirect()->route('descontos.index')->with('success', 'Desconto removido com sucesso.');
    }
}
