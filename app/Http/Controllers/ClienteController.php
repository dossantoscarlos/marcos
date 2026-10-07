<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ClienteController extends Controller
{
    public function index(): View
    {
        $clientes = Cliente::query()->latest()->paginate(15);

        return view('clientes.index', compact('clientes'));
    }

    public function create(): View
    {
        return view('clientes.create');
    }

    public function store(StoreClienteRequest $request): RedirectResponse
    {
        Cliente::create([
            ...$request->validated(),
            'uuid' => (string) Str::uuid(),
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso.');
    }

    public function show(Cliente $cliente): View
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente): View
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(UpdateClienteRequest $request, Cliente $cliente): RedirectResponse
    {
        $cliente->update($request->validated());

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso.');
    }

    public function destroy(Cliente $cliente): RedirectResponse
    {
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso.');
    }
}
