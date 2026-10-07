@props(['pedido' => null, 'clientes' => collect(), 'produtos' => collect()])
<div class="grid gap-4 sm:grid-cols-2">
    <x-form.input label="Código do pedido" name="codigo_pedido" :value="$pedido?->codigo_pedido" required />
    <x-form.input label="Situação" name="situacao" :value="$pedido?->situacao ?? 'pendente'" />
    <x-form.select label="Cliente" name="cliente_id" :value="$pedido?->cliente_id" :options="$clientes->pluck('nome', 'id')" />
    <x-form.select label="Produto" name="produto_id" :value="$pedido?->produto_id" :options="$produtos->pluck('nome', 'id')" />
</div>
