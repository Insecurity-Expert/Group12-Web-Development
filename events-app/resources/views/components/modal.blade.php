@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$sizeClass = match($maxWidth) {
    'sm' => 'modal-sm',
    'lg' => 'modal-lg',
    'xl', '2xl' => 'modal-xl',
    default => '',
};
@endphp

<div class="modal fade" id="{{ $name }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog {{ $sizeClass }}">
        <div class="modal-content">
            {{ $slot }}
        </div>
    </div>
</div>

@if($show)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new bootstrap.Modal(document.getElementById('{{ $name }}')).show();
    });
</script>
@endif
