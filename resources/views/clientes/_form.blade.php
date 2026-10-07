@props(['cliente' => null])

<div class="grid gap-4 sm:grid-cols-2">
    <x-form.input label="Nome" name="nome" :value="$cliente?->nome" required />
    <x-form.input label="E-mail" name="email" type="email" :value="$cliente?->email" />
    <x-form.input label="Telefone" name="telefone" :value="$cliente?->telefone" />
    <x-form.select label="Status" name="status" :value="$cliente?->status ?? 'ativo'" :options="['ativo' => 'Ativo', 'inativo' => 'Inativo']" />
    <x-form.input label="Endereço" name="endereco" :value="$cliente?->endereco" />
    <x-form.input label="Cidade" name="cidade" :value="$cliente?->cidade" />
    <x-form.input label="Estado" name="estado" :value="$cliente?->estado" />
    <x-form.input label="CEP" name="cep" :value="$cliente?->cep" />
</div>
