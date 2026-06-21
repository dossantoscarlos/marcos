@props(['promocao' => null])
<div class="grid gap-4 sm:grid-cols-2">
    <x-form.input label="Nome" name="nome" :value="$promocao?->nome" required />
    <x-form.input label="Percentual (%)" name="percentual" type="number" step="0.01" :value="$promocao?->percentual" required />
    <x-form.input label="Data início" name="data_inicio" type="date" :value="$promocao?->data_inicio?->format('Y-m-d')" required />
    <x-form.input label="Data fim" name="data_fim" type="date" :value="$promocao?->data_fim?->format('Y-m-d')" required />
    <x-form.input label="Situação" name="situacao" :value="$promocao?->situacao ?? 'ativo'" />
    <div class="sm:col-span-2"><x-form.textarea label="Descrição" name="descricao" :value="$promocao?->descricao" /></div>
</div>
