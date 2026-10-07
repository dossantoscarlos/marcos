@extends('layouts.app')

@section('title', 'Descontos')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Descontos</h1>
        <a href="{{ route('descontos.create') }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Novo desconto</a>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-600">Nome</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-600">Percentual</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-600">Situação</th>
                    <th class="px-4 py-3 text-right font-medium text-gray-600">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($descontos as $desconto)
                    <tr>
                        <td class="px-4 py-3">{{ $desconto->nome }}</td>
                        <td class="px-4 py-3">{{ number_format($desconto->percentual, 2, ',', '.') }}%</td>
                        <td class="px-4 py-3">{{ $desconto->situacao ?? 'ativo' }}</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('descontos.show', $desconto) }}" class="text-blue-600 hover:underline">Ver</a>
                            <a href="{{ route('descontos.edit', $desconto) }}" class="text-blue-600 hover:underline">Editar</a>
                            <form action="{{ route('descontos.destroy', $desconto) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Remover este desconto?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-gray-500">Nenhum desconto cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $descontos->links() }}</div>
@endsection
