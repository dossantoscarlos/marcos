@props(['desconto' => null])

<div class="grid gap-4 sm:grid-cols-2">
    <x-form.input label="Nome" name="nome" :value="$desconto?->nome" required />
    <x-form.input label="Percentual (%)" name="percentual" type="number" step="0.01" :value="$desconto?->percentual" required />
    <x-form.input label="Situação" name="situacao" :value="$desconto?->situacao ?? 'ativo'" />
    <div class="sm:col-span-2">
        <x-form.textarea label="Descrição" name="descricao" :value="$desconto?->descricao" />
    </div>
</div>
