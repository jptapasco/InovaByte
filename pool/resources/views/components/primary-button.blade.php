@props(['type' => 'button', 'iconL' => '', 'iconR' => '', 'color' => 'success'])

<button {{ $attributes->merge(['type' => $type, 'class' => 'btn btn-' . $color]) }}>
    @if ($iconL != '') <i class="{{ $iconL }}"></i> @endif 
    {{ $slot }} 
    @if ($iconR != '') <i class="{{ $iconR }}"></i> @endif
</button>