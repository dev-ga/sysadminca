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

        @wireUiScripts
        {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-900">

            <div class="fixed w-full mb-2 p-1">
                {{-- <div class="flex justify-start">
                  <a
                    href="{{ route('login') }}"
                    type="button"
                    class="rounded-md border border-[#fd033f] p-4 uppercase leading-normal text-surface shadow-dark-3 shadow-black/30 transition duration-150 ease-in-out hover:shadow-dark-1 focus:shadow-dark-1 focus:outline-none focus:ring-0 active:shadow-1 text-white hover:bg-[#fd033f]"
                    data-twe-ripple-init
                    data-twe-ripple-color="light">
                    <span class="[&>svg]:h-5 [&>svg]:w-5">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                      </svg>                  
                    </span>
                  </a>
                </div> --}}
                <livewire:layout.navigation />    
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
    </body>
</html>
