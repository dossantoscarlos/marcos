@extends('layouts.app')
@section('title', 'Editar preço')
@section('content')
    <div class="mb-6"><h1 class="text-2xl font-semibold">Editar preço</h1></div>
    <form action="{{ route('precos.update', $preco) }}" method="POST" class="max-w-3xl space-y-6 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        @csrf @method('PUT') @include('precos._form', ['preco' => $preco, 'produtos' => $produtos, 'descontos' => $descontos])
        <div class="flex gap-3">
            <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Atualizar</button>
            <a href="{{ route('precos.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Cancelar</a>
        </div>
    </form>
@endsection
