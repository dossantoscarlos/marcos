@extends('layouts.app')

@section('title', $desconto->nome)

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold">{{ $desconto->nome }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('descontos.edit', $desconto) }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Editar</a>
            <a href="{{ route('descontos.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Voltar</a>
        </div>
    </div>

    <dl class="max-w-3xl divide-y divide-gray-200 rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="grid grid-cols-3 gap-4 px-6 py-4">
            <dt class="text-sm font-medium text-gray-500">Nome</dt>
            <dd class="col-span-2 text-sm">{{ $desconto->nome }}</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4">
            <dt class="text-sm font-medium text-gray-500">Percentual</dt>
            <dd class="col-span-2 text-sm">{{ number_format($desconto->percentual, 2, ',', '.') }}%</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4">
            <dt class="text-sm font-medium text-gray-500">Situação</dt>
            <dd class="col-span-2 text-sm">{{ $desconto->situacao ?? 'ativo' }}</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4">
            <dt class="text-sm font-medium text-gray-500">Descrição</dt>
            <dd class="col-span-2 text-sm">{{ $desconto->descricao ?: '—' }}</dd>
        </div>
    </dl>
@endsection
