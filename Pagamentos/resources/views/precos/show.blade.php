@extends('layouts.app')
@section('title', 'Preço #' . $preco->id)
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Preço #{{ $preco->id }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('precos.edit', $preco) }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Editar</a>
            <a href="{{ route('precos.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Voltar</a>
        </div>
    </div>
    <dl class="max-w-3xl divide-y divide-gray-200 rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Produto</dt><dd class="col-span-2 text-sm">{{ $preco->produto?->nome ?? '—' }}</dd></div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Desconto</dt><dd class="col-span-2 text-sm">{{ $preco->desconto?->nome ?? '—' }}</dd></div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Preço</dt><dd class="col-span-2 text-sm">R$ {{ number_format($preco->preco, 2, ',', '.') }}</dd></div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Medida</dt><dd class="col-span-2 text-sm">{{ $preco->medida ?? 'unidade' }}</dd></div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Situação</dt><dd class="col-span-2 text-sm">{{ $preco->situacao ?? 'ativo' }}</dd></div>
    </dl>
@endsection
