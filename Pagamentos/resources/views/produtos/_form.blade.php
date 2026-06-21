@props(['produto' => null])
<div class="grid gap-4 sm:grid-cols-2">
    <x-form.input label="Nome" name="nome" :value="$produto?->nome" required />
    <x-form.input label="SKU" name="sku" :value="$produto?->sku" required />
    <x-form.input label="Preço" name="preco" type="number" step="0.01" :value="$produto?->preco" required />
    <x-form.input label="Imagem (URL)" name="imagem" :value="$produto?->imagem" required />
    <x-form.input label="Categoria" name="categoria" :value="$produto?->categoria" required />
    <x-form.input label="Subcategoria" name="subcategoria" :value="$produto?->subcategoria" required />
    <x-form.input label="Marca" name="marca" :value="$produto?->marca" required />
    <x-form.input label="Modelo" name="modelo" :value="$produto?->modelo" required />
    <x-form.input label="Cor" name="cor" :value="$produto?->cor" required />
    <x-form.input label="Tamanho" name="tamanho" :value="$produto?->tamanho" required />
    <x-form.input label="Material" name="material" :value="$produto?->material" required />
    <x-form.input label="Tipo" name="tipo" :value="$produto?->tipo" required />
    <x-form.input label="Estilo" name="estilo" :value="$produto?->estilo" />
    <x-form.input label="Gênero" name="genero" :value="$produto?->genero" />
    <x-form.input label="Idade" name="idade" :value="$produto?->idade" />
    <x-form.select label="Status" name="status" :value="$produto?->status ?? 'ativo'" :options="['ativo' => 'Ativo', 'inativo' => 'Inativo']" />
    <x-form.input label="Tags" name="tags" :value="$produto?->tags" />
    <div class="sm:col-span-2"><x-form.textarea label="Descrição" name="descricao" :value="$produto?->descricao" required /></div>
</div>
