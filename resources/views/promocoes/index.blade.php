@extends('layouts.app')
@section('title', 'Promoções')
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Promoções</h1>
        <a href="{{ route('promocoes.create') }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Nova promoção</a>
    </div>
    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50"><tr>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Nome</th>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Percentual</th>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Período</th>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Situação</th>
                <th class="px-4 py-3 text-right font-medium text-gray-600">Ações</th>
            </tr></thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($promocoes as $promocao)
                    <tr>
                        <td class="px-4 py-3">{{ $promocao->nome }}</td>
                        <td class="px-4 py-3">{{ number_format($promocao->percentual, 2, ',', '.') }}%</td>
                        <td class="px-4 py-3">{{ $promocao->data_inicio?->format('d/m/Y') }} — {{ $promocao->data_fim?->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ $promocao->situacao ?? 'ativo' }}</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('promocoes.show', $promocao) }}" class="text-blue-600 hover:underline">Ver</a>
                            <a href="{{ route('promocoes.edit', $promocao) }}" class="text-blue-600 hover:underline">Editar</a>
                            <form action="{{ route('promocoes.destroy', $promocao) }}" method="POST" class="inline">@csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Remover esta promoção?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Nenhuma promoção cadastrada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $promocoes->links() }}</div>
@endsection
