@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-black-700 dark:text-black-300 background:gray']) }}>
    {{ $value ?? $slot }}
</label>
