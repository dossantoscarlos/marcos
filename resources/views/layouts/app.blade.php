<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-900 antialiased">
    <nav class="border-b border-gray-200 bg-white">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center gap-4 px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-900">{{ config('app.name', 'Pagamentos') }}</a>
            <div class="flex flex-wrap gap-2 text-sm">
                <a href="{{ route('clientes.index') }}" class="rounded-md px-3 py-1.5 hover:bg-gray-100 {{ request()->routeIs('clientes.*') ? 'bg-gray-100 font-medium' : '' }}">Clientes</a>
                <a href="{{ route('produtos.index') }}" class="rounded-md px-3 py-1.5 hover:bg-gray-100 {{ request()->routeIs('produtos.*') ? 'bg-gray-100 font-medium' : '' }}">Produtos</a>
                <a href="{{ route('descontos.index') }}" class="rounded-md px-3 py-1.5 hover:bg-gray-100 {{ request()->routeIs('descontos.*') ? 'bg-gray-100 font-medium' : '' }}">Descontos</a>
                <a href="{{ route('promocoes.index') }}" class="rounded-md px-3 py-1.5 hover:bg-gray-100 {{ request()->routeIs('promocoes.*') ? 'bg-gray-100 font-medium' : '' }}">Promoções</a>
                <a href="{{ route('precos.index') }}" class="rounded-md px-3 py-1.5 hover:bg-gray-100 {{ request()->routeIs('precos.*') ? 'bg-gray-100 font-medium' : '' }}">Preços</a>
                <a href="{{ route('pedidos.index') }}" class="rounded-md px-3 py-1.5 hover:bg-gray-100 {{ request()->routeIs('pedidos.*') ? 'bg-gray-100 font-medium' : '' }}">Pedidos</a>
                <a href="{{ route('pagamentos.index') }}" class="rounded-md px-3 py-1.5 hover:bg-gray-100 {{ request()->routeIs('pagamentos.*') ? 'bg-gray-100 font-medium' : '' }}">Pagamentos</a>
            </div>
        </div>
    </nav>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <x-alert />

        @yield('content')
    </main>
</body>
</html>
