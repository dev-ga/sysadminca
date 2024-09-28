<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="icon" sizes="256x256" href="{{ asset('image/favicon.ico') }}">
        <link rel="icon" sizes="180x180" href="{{ asset('image/favicon.ico') }}">
        <link rel="apple-touch-icon" href="{{ asset('image/logo.png') }}"/>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- wireUi -->
        @wireUiScripts


        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="flex h-screen justify-center items-center bg-slate-800">
            <div class="mx-auto flex justify-center px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8">
                <div class="text-center ">
                    <h1
                        class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                        <div class="flex items-center justify-center">
                            <div class="items-center">
                                <img src="{{ asset('image/logo.png') }}" class="w-[40rem] h-auto" alt="">
                            </div>
                        </div>

                        <div class="flex justify-center mt-1">
                                <span class="relative text-xl uppercase">Sistema Adiministrativo Integral</span>
                        </div>
                    </h1>
                    <div class="flex justify-center items-center gap-2">
                        <div class="flex mt-6">
                            <a class="flex items-center justify-center w-full" href="{{ route('login') }}">
                                <button class="flex justify-center rounded-3xl border border-[#fd033f] py-4 px-6 mt-1 text-md items-center sm:text-center font-bold text-white shadow-sm hover:bg-[#fd033f] uppercase">
                                    <span class="text-center font-extrabold items-center shadow-2xl">Login</span>
                                </button>
                            </a>
                        </div>
                        <div class="flex mt-6">
                            <a class="flex items-center justify-center w-full" href="{{ route('register') }}">
                                <button class="flex justify-center rounded-3xl border border-[#fd033f] py-4 px-6 mt-1 text-md items-center sm:text-center font-bold text-white shadow-sm hover:bg-[#fd033f] uppercase">
                                    <span class="text-center font-extrabold items-center shadow-2xl">Registro</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <footer class="fixed bottom-0 flex flex-col items-center text-center text-surfac">

                    <!-- Iconos -->
                    <div class="mb-2 flex justify-center space-x-2">
                        <a
                          href="#!"
                          type="button"
                          class="rounded-full border border-[#fd033f] p-3 uppercase leading-normal text-surface shadow-dark-3 shadow-black/30 transition duration-150 ease-in-out hover:shadow-dark-1 focus:shadow-dark-1 focus:outline-none focus:ring-0 active:shadow-1 text-white hover:bg-[#fd033f]"
                          data-twe-ripple-init
                          data-twe-ripple-color="light">
                          <span class="[&>svg]:h-5 [&>svg]:w-5">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              fill="currentColor"
                              viewBox="0 0 320 512">
                              <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
                              <path
                                d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z" />
                            </svg>
                          </span>
                        </a>
                  
                        <a
                          href="#!"
                          type="button"
                          class="rounded-full rounded-full border border-[#fd033f] p-3 uppercase leading-normal text-surface shadow-dark-3 shadow-black/30 transition duration-150 ease-in-out hover:shadow-dark-1 focus:shadow-dark-1 focus:outline-none focus:ring-0 active:shadow-1 text-white hover:bg-[#fd033f]"
                          data-twe-ripple-init
                          data-twe-ripple-color="light">
                          <span class="mx-auto [&>svg]:h-5 [&>svg]:w-5">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              fill="currentColor"
                              viewBox="0 0 448 512">
                              <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
                              <path
                                d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                            </svg>
                          </span>
                        </a>
                    </div>
        
                    <!--Copyright section-->
                    <div class="w-full p-4 text-center text-white text-xs">
                        © 2024 Copyright:
                        <a href="https://tw-elements.com/">Ciudad Alternativa. All Rights Reserved.</a>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
