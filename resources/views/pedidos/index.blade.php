@extends('layouts.app')
@section('title', 'Pedidos')
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Pedidos</h1>
        <a href="{{ route('pedidos.create') }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Novo pedido</a>
    </div>
    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50"><tr>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Código</th>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Cliente</th>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Produto</th>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Situação</th>
                <th class="px-4 py-3 text-right font-medium text-gray-600">Ações</th>
            </tr></thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($pedidos as $pedido)
                    <tr>
                        <td class="px-4 py-3">{{ $pedido->codigo_pedido }}</td>
                        <td class="px-4 py-3">{{ $pedido->cliente?->nome ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $pedido->produto?->nome ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $pedido->situacao ?? 'pendente' }}</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('pedidos.show', $pedido) }}" class="text-blue-600 hover:underline">Ver</a>
                            <a href="{{ route('pedidos.edit', $pedido) }}" class="text-blue-600 hover:underline">Editar</a>
                            <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST" class="inline">@csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Remover este pedido?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Nenhum pedido cadastrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $pedidos->links() }}</div>
@endsection
