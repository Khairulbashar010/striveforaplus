<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'StriveForA+') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css">

    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.umd.js"></script>
    
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        @include('partials.navbar')

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif
        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif
        @if (session('warning'))
            <x-alert type="warning" :message="session('warning')" />
        @endif
        @if (session('info'))
            <x-alert type="info" :message="session('info')" />
        @endif
        <!-- Main Content -->
        <main class="container mx-auto mt-6 px-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

