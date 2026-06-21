@extends('layouts.app')
@section('title', 'Pagamentos')
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Pagamentos</h1>
        <a href="{{ route('pagamentos.create') }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Novo pagamento</a>
    </div>
    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50"><tr>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Cliente</th>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Pedido</th>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Valor</th>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Situação</th>
                <th class="px-4 py-3 text-right font-medium text-gray-600">Ações</th>
            </tr></thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($pagamentos as $pagamento)
                    <tr>
                        <td class="px-4 py-3">{{ $pagamento->cliente?->nome ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $pagamento->pedido?->codigo_pedido ?? '—' }}</td>
                        <td class="px-4 py-3">R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $pagamento->situacao ?? 'pendente' }}</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('pagamentos.show', $pagamento) }}" class="text-blue-600 hover:underline">Ver</a>
                            <a href="{{ route('pagamentos.edit', $pagamento) }}" class="text-blue-600 hover:underline">Editar</a>
                            <form action="{{ route('pagamentos.destroy', $pagamento) }}" method="POST" class="inline">@csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Remover este pagamento?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Nenhum pagamento cadastrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $pagamentos->links() }}</div>
@endsection
