@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Clientes</h1>
        <a href="{{ route('clientes.create') }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Novo cliente</a>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-600">Nome</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-600">E-mail</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-600">Telefone</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-600">Status</th>
                    <th class="px-4 py-3 text-right font-medium text-gray-600">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($clientes as $cliente)
                    <tr>
                        <td class="px-4 py-3">{{ $cliente->nome }}</td>
                        <td class="px-4 py-3">{{ $cliente->email ?: '—' }}</td>
                        <td class="px-4 py-3">{{ $cliente->telefone ?: '—' }}</td>
                        <td class="px-4 py-3">{{ $cliente->status ?? 'ativo' }}</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('clientes.show', $cliente) }}" class="text-blue-600 hover:underline">Ver</a>
                            <a href="{{ route('clientes.edit', $cliente) }}" class="text-blue-600 hover:underline">Editar</a>
                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Remover este cliente?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Nenhum cliente cadastrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $clientes->links() }}</div>
@endsection
