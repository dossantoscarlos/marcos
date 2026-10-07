@extends('layouts.app')
@section('title', $promocao->nome)
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold">{{ $promocao->nome }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('promocoes.edit', $promocao) }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Editar</a>
            <a href="{{ route('promocoes.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Voltar</a>
        </div>
    </div>
    <dl class="max-w-3xl divide-y divide-gray-200 rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Percentual</dt><dd class="col-span-2 text-sm">{{ number_format($promocao->percentual, 2, ',', '.') }}%</dd></div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Período</dt><dd class="col-span-2 text-sm">{{ $promocao->data_inicio?->format('d/m/Y') }} — {{ $promocao->data_fim?->format('d/m/Y') }}</dd></div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Situação</dt><dd class="col-span-2 text-sm">{{ $promocao->situacao ?? 'ativo' }}</dd></div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Descrição</dt><dd class="col-span-2 text-sm">{{ $promocao->descricao ?: '—' }}</dd></div>
    </dl>
@endsection
