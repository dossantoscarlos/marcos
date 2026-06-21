@extends('layouts.app')
@section('title', $pedido->codigo_pedido)
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold">{{ $pedido->codigo_pedido }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('pedidos.edit', $pedido) }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Editar</a>
            <a href="{{ route('pedidos.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Voltar</a>
        </div>
    </div>
    <dl class="max-w-3xl divide-y divide-gray-200 rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Cliente</dt><dd class="col-span-2 text-sm">{{ $pedido->cliente?->nome ?? '—' }}</dd></div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Produto</dt><dd class="col-span-2 text-sm">{{ $pedido->produto?->nome ?? '—' }}</dd></div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Situação</dt><dd class="col-span-2 text-sm">{{ $pedido->situacao ?? 'pendente' }}</dd></div>
    </dl>
@endsection
