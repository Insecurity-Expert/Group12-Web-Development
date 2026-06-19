@props(['align' => 'right', 'width' => '48', 'contentClasses' => ''])

@php
$menuAlignClass = $align === 'left' ? '' : 'dropdown-menu-end';
@endphp

<div class="dropdown">
    <div data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
        {{ $trigger }}
    </div>
    <ul class="dropdown-menu {{ $menuAlignClass }} {{ $contentClasses }}">
        {{ $content }}
    </ul>
</div>
