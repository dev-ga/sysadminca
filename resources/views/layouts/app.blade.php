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
    <div class="min-h-screen bg-gray-900">
        {{-- <livewire:layout.navigation />     --}}
        @livewire('menu-employee')
        {{-- <nav class="bg-black text-white border-gray-200 dark:border-gray-600 dark:bg-gray-900">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-2 text-white">
                <a href="https://flowbite.com" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <div class="items-center">
                        <img src="{{ asset('image/logo.png') }}" class="w-40 h-auto" alt="">
                    </div>
                </a>
                <button data-collapse-toggle="mega-menu-full" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mega-menu-full" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
                <div id="mega-menu-full" class="text-white items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
                    <ul class="flex flex-col mt-4 font-medium md:flex-row md:mt-0 md:space-x-8 rtl:space-x-reverse">
                        <li>
                            <button id="mega-menu-full-dropdown-button" data-collapse-toggle="mega-menu-full-dropdown" class="text-white flex items-center justify-between w-full py-2 px-3 font-medium text-gray-900 border-b border-gray-100 md:w-auto hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">
                                Tienda Fisica
                                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- Dropdown options Online -->
            <div id="mega-menu-full-dropdown" class="mt-1 bg-Black border-gray-200 shadow-sm border-y dark:bg-gray-800 dark:border-gray-600">
                <div class="grid max-w-screen-xl px-4 py-5 mx-auto dark:text-white sm:grid-cols-2 md:grid-cols-3 md:px-6">
                    <ul aria-labelledby="mega-menu-full-dropdown-button">
                        <li class="hover:text-black hover:font-extrabold">
                            <a href="#" class="block p-3 rounded-lg hover:bg-[#fd033f] hover:border-[#fd033f] dark:hover:bg-gray-700">
                                <div class="font-semibold">BCV</div>
                                <span class="text-sm text-white dark:text-gray-400">Actualiza la tasa del BCV para poder realizar el ejercicio financiero del dia</span>
                            </a>
                        </li>
                        <li class="hover:text-black hover:font-extrabold">
                            <a href="#" class="block p-3 rounded-lg hover:bg-[#fd033f] hover:border-[#fd033f] dark:hover:bg-gray-700">
                                <div class="font-semibold">CAJA - FACTURACION</div>
                                <span class="text-sm text-white dark:text-gray-400">Facturacion de Ventas en piso de ventas y ON-LINE</span>
                            </a>
                        </li>
                        <li class="hover:text-black hover:font-extrabold">
                            <a href="#" class="block p-3 rounded-lg hover:bg-[#fd033f] hover:border-[#fd033f] dark:hover:bg-gray-700">
                                <div class="font-semibold">CIERRE DIARIO</div>
                                <span class="text-sm text-white dark:text-gray-400">Cierre del ejercicio financiero. Esto lo realiza el usuario encargado del dia</span>
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li class="hover:text-black hover:font-extrabold">
                            <a href="#" class="block p-3 rounded-lg hover:bg-[#fd033f] hover:border-[#fd033f] dark:hover:bg-gray-700">
                                <div class="font-semibold">GASTOS</div>
                                <span class="text-sm text-white dark:text-gray-400">Registro de gastos diarios de cualquier tipo</span>
                            </a>
                        </li>
                        <li class="hover:text-black hover:font-extrabold">
                            <a href="#" class="block p-3 rounded-lg hover:bg-[#fd033f] hover:border-[#fd033f] dark:hover:bg-gray-700">
                                <div class="font-semibold">PRODUCTOS</div>
                                <span class="text-sm text-white dark:text-gray-400">Inventario Ciudad Alternativa</span>
                            </a>
                        </li>
                        <li class="hover:text-black hover:font-extrabold">
                          <a href="#" class="block p-3 rounded-lg hover:bg-[#fd033f] hover:border-[#fd033f] dark:hover:bg-gray-700">
                              <div class="font-semibold">TIENDA ON-LINE</div>
                              <span class="text-sm text-white dark:text-gray-400">Servicio de compra y venta ON-LINE</span>
                          </a>
                      </li>
                    </ul>
                    <ul class="hidden md:block">
                        <li class="hover:text-black hover:font-extrabold">
                            <a href="#" class="block p-3 rounded-lg hover:bg-[#fd033f] hover:border-[#fd033f] dark:hover:bg-gray-700">
                                <div class="font-semibold">VENTA DIARIA</div>
                                <span class="text-sm text-white dark:text-gray-400">Tabla de ventas del dia. Esta tabla refleja todos los movimientos del dia actual</span>
                            </a>
                        </li>
                        <li class="hover:text-black hover:font-extrabold">
                            <a href="#" class="block p-3 rounded-lg hover:bg-[#fd033f] hover:border-[#fd033f] dark:hover:bg-gray-700">
                                <div class="font-semibold">PERFIL DE USUARIO</div>
                                <span class="text-sm text-white dark:text-gray-400">Modulo de perfil y gestion de Usuario</span>
                            </a>
                        </li>
                        <li class="hover:text-black hover:font-extrabold">
                            <a href="#" class="block p-3 rounded-lg hover:bg-[#fd033f] hover:border-[#fd033f] dark:hover:bg-gray-700">
                                <div class="font-semibold">CERRAR SESION</div>
                                <span class="text-sm text-white dark:text-gray-400">Cierre de Sesion del sistema</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav> --}}
        <!-- Page Heading -->
        {{-- @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        
                    </div>
                </header>
            @endif --}}

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @filamentScripts

    @livewire('wire-elements-modal')
</body>
</html>

