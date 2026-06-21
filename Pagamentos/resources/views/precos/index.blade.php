@extends('layouts.app')
@section('title', 'Preços')
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Preços</h1>
        <a href="{{ route('precos.create') }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Novo preço</a>
    </div>
    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50"><tr>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Produto</th>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Desconto</th>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Preço</th>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Situação</th>
                <th class="px-4 py-3 text-right font-medium text-gray-600">Ações</th>
            </tr></thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($precos as $preco)
                    <tr>
                        <td class="px-4 py-3">{{ $preco->produto?->nome ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $preco->desconto?->nome ?? '—' }}</td>
                        <td class="px-4 py-3">R$ {{ number_format($preco->preco, 2, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $preco->situacao ?? 'ativo' }}</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('precos.show', $preco) }}" class="text-blue-600 hover:underline">Ver</a>
                            <a href="{{ route('precos.edit', $preco) }}" class="text-blue-600 hover:underline">Editar</a>
                            <form action="{{ route('precos.destroy', $preco) }}" method="POST" class="inline">@csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Remover este preço?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Nenhum preço cadastrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $precos->links() }}</div>
@endsection
