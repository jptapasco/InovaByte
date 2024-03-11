@props(['value'])

<label {{ $attributes->merge(['class' => 'text-light']) }}>
    {{ $value ?? $slot }}
</label>
