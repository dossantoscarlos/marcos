@props(['preco' => null, 'produtos' => collect(), 'descontos' => collect()])
<div class="grid gap-4 sm:grid-cols-2">
    <x-form.select label="Produto" name="produto_id" :value="$preco?->produto_id" :options="$produtos->pluck('nome', 'id')" required />
    <x-form.select label="Desconto" name="desconto_id" :value="$preco?->desconto_id" :options="$descontos->pluck('nome', 'id')" />
    <x-form.input label="Preço" name="preco" type="number" step="0.01" :value="$preco?->preco" required />
    <x-form.input label="Medida" name="medida" :value="$preco?->medida ?? 'unidade'" />
    <x-form.input label="Situação" name="situacao" :value="$preco?->situacao ?? 'ativo'" />
</div>
