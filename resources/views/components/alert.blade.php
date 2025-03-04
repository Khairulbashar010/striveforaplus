@props(['type' => 'info', 'message'])

@php
    $classes = [
        'info' => 'bg-blue-100 border-blue-500 text-blue-700',
        'success' => 'bg-green-100 border-green-500 text-green-700',
        'warning' => 'bg-yellow-100 border-yellow-500 text-yellow-700',
        'error' => 'bg-red-100 border-red-500 text-red-700',
    ][$type];
@endphp

<div x-data="{ show: true }" x-init="setTimeout(() => { if (!document.querySelector('.alert:hover')) show = false }, 1000)" x-show="show"
    class="absolute top-8 right-0 my-8 border-l-4 p-4 {{ $classes }} transition-opacity duration-500 ease-in-out alert" 
    role="alert">
    <p class="font-bold">{{ ucfirst($type) }}</p>
    <p>{{ $message }}</p>
</div>