@extends('layouts.app')
@section('title', $produto->nome)
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold">{{ $produto->nome }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('produtos.edit', $produto) }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Editar</a>
            <a href="{{ route('produtos.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Voltar</a>
        </div>
    </div>
    <dl class="max-w-4xl divide-y divide-gray-200 rounded-lg border border-gray-200 bg-white shadow-sm">
        @foreach (['sku' => 'SKU', 'preco' => 'Preço', 'categoria' => 'Categoria', 'marca' => 'Marca', 'status' => 'Status'] as $field => $label)
            <div class="grid grid-cols-3 gap-4 px-6 py-4">
                <dt class="text-sm font-medium text-gray-500">{{ $label }}</dt>
                <dd class="col-span-2 text-sm">@if($field === 'preco') R$ {{ number_format($produto->preco, 2, ',', '.') }} @else {{ $produto->{$field} ?: '—' }} @endif</dd>
            </div>
        @endforeach
        <div class="grid grid-cols-3 gap-4 px-6 py-4">
            <dt class="text-sm font-medium text-gray-500">Descrição</dt>
            <dd class="col-span-2 text-sm">{{ $produto->descricao }}</dd>
        </div>
    </dl>
@endsection
