<div>
    <nav class="bg-black text-white border-gray-200 dark:border-gray-600 dark:bg-gray-900">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4 text-white">
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
                <ul class="flex flex-col items-center font-medium md:flex-row md:space-x-8 rtl:space-x-reverse">
                    <li>
                        <button id="mega-menu-full-dropdown-button" aria-controls="menu" data-collapse-toggle="menu" type="button" class="text-white bg-[#fd033f] hover:bg-[#050708]/90 hover:border hover:border-[#fd033f] focus:ring-4 focus:outline-none focus:ring-[#050708]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#050708]/50 dark:hover:bg-[#050708]/30">
                            Menu Tienda Fisica
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                    </li>
                    <li>
                        <button class="text-white border border-[#fd033f] font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center dark:focus:ring-[#050708]/50 dark:hover:bg-[#050708]/30">
                            <img class="w-5 h-auto mr-1" src="{{ asset('image/logo_bcv_2.png') }}" alt="">
                            BCV : {{ $tasa }}Bs.
                        </button>
                    </li>

                </ul>
            </div>
        </div>
        <!-- Dropdown options Online -->
        <div id="menu" class="hidden mt-1 bg-Black border-gray-200 shadow-sm border-y dark:bg-gray-800 dark:border-gray-600">
            <div class="grid max-w-screen-xl px-4 py-5 mx-auto dark:text-white sm:grid-cols-2 md:grid-cols-3 md:px-6">
                <ul aria-labelledby="mega-menu-full-dropdown-button">
                    {{-- <li class="hover:text-black hover:font-extrabold">
                        <a href="{{ route('bcv') }}" class="block p-3 rounded-lg hover:bg-[#fd033f] dark:hover:bg-gray-700">
                            <div class="font-semibold">BCV</div>
                            <span class="text-sm text-white dark:text-gray-400">{{ $tasa }}Bs. por Dolar</span>
                        </a>
                    </li> --}}
                    <li class="hover:text-black hover:font-extrabold">
                        <a href="{{ route('box') }}" class="block p-3 rounded-lg hover:bg-[#fd033f] dark:hover:bg-gray-700">
                            <div class="font-semibold">CAJA - FACTURACION</div>
                            <span class="text-sm text-white dark:text-gray-400">Facturacion de Ventas en piso de ventas y ON-LINE</span>
                        </a>
                    </li>
                    <li class="hover:text-black hover:font-extrabold">
                        <a href="{{ route('daily-closing') }}" class="block p-3 rounded-lg hover:bg-[#fd033f] dark:hover:bg-gray-700">
                            <div class="font-semibold">CIERRE DIARIO</div>
                            <span class="text-sm text-white dark:text-gray-400">Cierre del ejercicio financiero. Esto lo realiza el usuario encargado del dia</span>
                        </a>
                    </li>
                    <li class="hover:text-black hover:font-extrabold">
                        <a href="{{ route('bills') }}" class="block p-3 rounded-lg hover:bg-[#fd033f] dark:hover:bg-gray-700">
                            <div class="font-semibold">GASTOS</div>
                            <span class="text-sm text-white dark:text-gray-400">Registro de gastos diarios de cualquier tipo</span>
                        </a>
                    </li>
                </ul>
                <ul>
                    <li class="hover:text-black hover:font-extrabold">
                        <a href="{{ route('inventory') }}" class="block p-3 rounded-lg hover:bg-[#fd033f] dark:hover:bg-gray-700">
                            <div class="font-semibold">PRODUCTOS</div>
                            <span class="text-sm text-white dark:text-gray-400">Inventario Ciudad Alternativa</span>
                        </a>
                    </li>
                    <li class="hover:text-black hover:font-extrabold">
                      <a href="{{ route('on-line') }}" class="block p-3 rounded-lg hover:bg-[#fd033f] dark:hover:bg-gray-700">
                          <div class="font-semibold">TIENDA ON-LINE</div>
                          <span class="text-sm text-white dark:text-gray-400">Servicio de compra y venta ON-LINE</span>
                      </a>
                  </li>
                  <li class="hover:text-black hover:font-extrabold">
                      <a href="{{ route('daily-sale') }}" class="block p-3 rounded-lg hover:bg-[#fd033f] dark:hover:bg-gray-700">
                          <div class="font-semibold">VENTA DIARIA</div>
                          <span class="text-sm text-white dark:text-gray-400">Tabla de ventas del dia. Esta tabla refleja todos los movimientos del dia actual</span>
                      </a>
                  </li>
                </ul>
                <ul>
                    <li class="hover:text-black hover:font-extrabold">
                        <a href="{{ route('roster') }}" class="block p-3 rounded-lg hover:bg-[#fd033f] dark:hover:bg-gray-700">
                            <div class="font-semibold">NOMINA</div>
                            <span class="text-sm text-white dark:text-gray-400">Modulo de perfil y gestion de Usuario</span>
                        </a>
                    </li>
                    <li class="hover:text-black hover:font-extrabold">
                        <a href="{{ route('profile') }}" class="block p-3 rounded-lg hover:bg-[#fd033f] dark:hover:bg-gray-700">
                            <div class="font-semibold">PERFIL DE USUARIO</div>
                            <span class="text-sm text-white dark:text-gray-400">Modulo de perfil y gestion de Usuario</span>
                        </a>
                    </li>
                    <li class="hover:text-black hover:font-extrabold">
                        <div wire:click="logout" class="block p-3 rounded-lg hover:bg-[#fd033f] dark:hover:bg-gray-700">
                            <div class="font-semibold">CERRAR SESION</div>
                            <span class="text-sm text-white dark:text-gray-400">Cierre de Sesion del sistema</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
</div>
