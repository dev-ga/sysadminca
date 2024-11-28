<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" sizes="256x256" href="{{ asset('image/favicon.ico') }}">
    <link rel="icon" sizes="180x180" href="{{ asset('image/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @wireUiScripts
    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}

    @filamentStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-200">

        <!-- Notifications WireUI -->
        <x-notifications position="bottom" />

        <!-- Dialog WireUI -->
        <x-dialog z-index="z-50" blur="md" align="center" class="bg-gray-700"/>
        
        @livewire('menu-employee')

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @filamentScripts
    @livewire('wire-elements-modal')
</body>
</html>

