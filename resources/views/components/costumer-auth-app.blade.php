<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" sizes="256x256" href="{{ asset('image/favicon.ico') }}">
        <link rel="icon" sizes="180x180" href="{{ asset('image/favicon.ico') }}">
        <link rel="apple-touch-icon" href="{{ asset('image/logo.png') }}"/>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Filepond -->
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @filamentStyles

        @wireUiScripts

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        

    </head>
    <body class="font-sans antialiased">

        <!-- Notifications WireUI -->
        <x-notifications position="bottom" />

        <!-- Dialog WireUI -->
        <x-dialog z-index="z-50" blur="md" align="center" class="bg-gray-700"/>

        <div class="min-h-screen bg-gray-900 text-white">

            <div class="fixed w-full mb-2 z-50">
                <livewire:layout.navigation-costumer />    
              </div>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @filamentScripts
    </body>
    {{-- <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('notifications-payment-registered', (event) => {
            $wireui.notify({
                title: 'Profile saved!',
                description: 'Your profile was successfully saved',
                icon: 'success'
            })
            });
        });
    </script> --}}
</html>

