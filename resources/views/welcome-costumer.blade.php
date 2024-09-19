<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- wireUi -->
        @wireUiScripts


        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="flex h-screen justify-center items-center dark:bg-slate-800">
            <div class="mx-auto flex justify-center px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8">
                <div class="text-center ">
                    <h1
                        class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-slate-200 sm:text-5xl md:text-6xl">
                        <span class="block xl:inline"><span class="mb-1 block">Bienvenidos a</span>
                        <div class="flex items-center justify-center">
                            <div class="items-center">
                                <img src="{{ asset('image/logo.png') }}" class="w-80 h-auto" alt="">
                            </div>
                        </div>
                        {{-- <span class="bg-gradient-to-r from-indigo-400 to-pink-600 bg-clip-text text-transparent">
                            Ciudad Alternativa
                        </span> --}}
                        </span>
                        <div class="mt-2">
                            <span class="relative mt-3 whitespace-nowrap text-white">
                                <svg aria-hidden="true" viewBox="0 0 418 42"
                                class="absolute top-3/4 left-0 right-0 m-auto h-[0.58em] w-fit fill-pink-400/50 mt-4"
                                preserveAspectRatio="none">
                                <path
                                    d="M203.371.916c-26.013-2.078-76.686 1.963-124.73 9.946L67.3 12.749C35.421 18.062 18.2 21.766 6.004 25.934 1.244 27.561.828 27.778.874 28.61c.07 1.214.828 1.121 9.595-1.176 9.072-2.377 17.15-3.92 39.246-7.496C123.565 7.986 157.869 4.492 195.942 5.046c7.461.108 19.25 1.696 19.17 2.582-.107 1.183-7.874 4.31-25.75 10.366-21.992 7.45-35.43 12.534-36.701 13.884-2.173 2.308-.202 4.407 4.442 4.734 2.654.187 3.263.157 15.593-.78 35.401-2.686 57.944-3.488 88.365-3.143 46.327.526 75.721 2.23 130.788 7.584 19.787 1.924 20.814 1.98 24.557 1.332l.066-.011c1.201-.203 1.53-1.825.399-2.335-2.911-1.31-4.893-1.604-22.048-3.261-57.509-5.556-87.871-7.36-132.059-7.842-23.239-.254-33.617-.116-50.627.674-11.629.54-42.371 2.494-46.696 2.967-2.359.259 8.133-3.625 26.504-9.81 23.239-7.825 27.934-10.149 28.304-14.005.417-4.348-3.529-6-16.878-7.066Z">
                                </path>
                                </svg>
                            <span class="relative uppercase">on-line</span>
                            </span>
                        </div>
                    </h1>
                    <div class="mt-10">
                        <p class="mx-auto max-w-xl text-lg text-gray-500 dark:text-slate-400">
                            Te damos la bienvenida a nuestro nuevo sistema de compras ON-LINE
                        </p>
                    </div>
                </div>
                <footer class="fixed bottom-0 flex flex-col items-center text-center w-full p-4">
                    <div class="flex items-center justify-center mt-6 w-full">
                        <a class="w-full" href="{{ route('login') }}">
                            <button class="flex justify-center w-full h-full rounded-3xl border border-[#fd033f] py-3 px-6 mt-1 text-sm items-center sm:text-center font-bold text-white shadow-sm hover:bg-[#fd033f] uppercase">
                                <span class="text-center items-center shadow-2xl">Siguiente</span>
                            </button>
                        </a>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
