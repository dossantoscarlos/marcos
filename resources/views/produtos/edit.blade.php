@extends('layouts.app')
@section('title', 'Editar produto')
@section('content')
    <div class="mb-6"><h1 class="text-2xl font-semibold">Editar produto</h1></div>
    <form action="{{ route('produtos.update', $produto) }}" method="POST" class="max-w-4xl space-y-6 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        @csrf @method('PUT') @include('produtos._form', ['produto' => $produto])
        <div class="flex gap-3">
            <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Atualizar</button>
            <a href="{{ route('produtos.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Cancelar</a>
        </div>
    </form>
@endsection
