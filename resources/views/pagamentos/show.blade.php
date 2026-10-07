@extends('layouts.app')
@section('title', 'Pagamento #' . $pagamento->id)
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Pagamento #{{ $pagamento->id }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('pagamentos.edit', $pagamento) }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Editar</a>
            <a href="{{ route('pagamentos.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Voltar</a>
        </div>
    </div>
    <dl class="max-w-3xl divide-y divide-gray-200 rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Cliente</dt><dd class="col-span-2 text-sm">{{ $pagamento->cliente?->nome ?? '—' }}</dd></div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Pedido</dt><dd class="col-span-2 text-sm">{{ $pagamento->pedido?->codigo_pedido ?? '—' }}</dd></div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Valor</dt><dd class="col-span-2 text-sm">R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</dd></div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Tipo</dt><dd class="col-span-2 text-sm">{{ $pagamento->tipo ?? 'dinheiro' }}</dd></div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Situação</dt><dd class="col-span-2 text-sm">{{ $pagamento->situacao ?? 'pendente' }}</dd></div>
        <div class="grid grid-cols-3 gap-4 px-6 py-4"><dt class="text-sm font-medium text-gray-500">Observações</dt><dd class="col-span-2 text-sm">{{ $pagamento->observacoes ?: '—' }}</dd></div>
    </dl>
@endsection
