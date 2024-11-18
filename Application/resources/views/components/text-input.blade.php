@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'mb-5 p-3 w-80 focus:border-blue-700 rounded border-2 outline-none']) }}>
