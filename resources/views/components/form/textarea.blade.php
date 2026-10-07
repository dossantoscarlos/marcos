@props(['label', 'name', 'value' => null, 'required' => false, 'rows' => 3])

<div {{ $attributes->merge(['class' => 'space-y-1']) }}>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}@if($required)<span class="text-red-500">*</span>@endif
    </label>
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        @if($required) required @endif
        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
    >{{ old($name, $value) }}</textarea>
</div>
