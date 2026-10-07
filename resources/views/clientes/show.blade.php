@extends('layouts.app')
@section('title', $cliente->nome)
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold">{{ $cliente->nome }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('clientes.edit', $cliente) }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Editar</a>
            <a href="{{ route('clientes.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Voltar</a>
        </div>
    </div>
    <dl class="max-w-3xl divide-y divide-gray-200 rounded-lg border border-gray-200 bg-white shadow-sm">
        @foreach (['nome' => 'Nome', 'email' => 'E-mail', 'telefone' => 'Telefone', 'endereco' => 'Endereço', 'cidade' => 'Cidade', 'estado' => 'Estado', 'cep' => 'CEP', 'status' => 'Status'] as $field => $label)
            <div class="grid grid-cols-3 gap-4 px-6 py-4">
                <dt class="text-sm font-medium text-gray-500">{{ $label }}</dt>
                <dd class="col-span-2 text-sm">{{ $cliente->{$field} ?: '—' }}</dd>
            </div>
        @endforeach
    </dl>
@endsection
