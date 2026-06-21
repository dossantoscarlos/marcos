@props(['pagamento' => null, 'clientes' => collect(), 'pedidos' => collect()])
<div class="grid gap-4 sm:grid-cols-2">
    <x-form.select label="Cliente" name="cliente_id" :value="$pagamento?->cliente_id" :options="$clientes->pluck('nome', 'id')" required />
    <x-form.select label="Pedido" name="pedido_id" :value="$pagamento?->pedido_id" :options="$pedidos->pluck('codigo_pedido', 'id')" required />
    <x-form.input label="Valor" name="valor" type="number" step="0.01" :value="$pagamento?->valor" required />
    <x-form.input label="Situação" name="situacao" :value="$pagamento?->situacao ?? 'pendente'" />
    <x-form.input label="Tipo" name="tipo" :value="$pagamento?->tipo ?? 'dinheiro'" />
    <x-form.input label="Data estimada" name="data_estimada_pagamento" :value="$pagamento?->data_estimada_pagamento" />
    <x-form.input label="Data efetiva" name="data_evetiva_pagamento" :value="$pagamento?->data_evetiva_pagamento" />
    <x-form.input label="Evidência" name="evidencia" :value="$pagamento?->evidencia" />
    <div class="sm:col-span-2"><x-form.textarea label="Observações" name="observacoes" :value="$pagamento?->observacoes" /></div>
</div>
