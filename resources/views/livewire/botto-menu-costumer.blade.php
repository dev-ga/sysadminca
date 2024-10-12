<div class="fixed bottom-0 z-50 w-full -translate-x-1/2 bg-[#fd033f] border-t border-[#fd033f] left-1/2 rounded-t-2xl">
    <div class="grid h-full max-w-lg grid-cols-4 mx-auto">
        <!-- Search -->
        @if (request()->routeIs('search-item'))
            <button wire:click='home' data-tooltip-target="tooltip-home" type="button" class="inline-flex flex-col items-center justify-center p-4 dark:hover:bg-gray-800 group">
                <svg class="w-6 h-6 mb-1 text-black font-extrabold" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                  
                <span class="sr-only">Buscador</span>
            </button>
        @else
            <button wire:click='home' data-tooltip-target="tooltip-home" type="button" class="inline-flex flex-col items-center justify-center p-4 dark:hover:bg-gray-800 group">
                <svg class="w-6 h-6 mb-1 text-white font-extrabold dark:text-gray-400 group-hover:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Buscador</span>
            </button>
        @endif

        <!-- shopping-car -->
        @if (request()->routeIs('shopping-car'))
            <button wire:click='car' data-tooltip-target="tooltip-bookmark" type="button" class="relative inline-flex flex-col items-center justify-center p-4 dark:hover:bg-gray-800 group">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 mb-1 text-black font-extrabold">
                    <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                  </svg>       
                <div class="absolute inline-flex items-center justify-center w-6 h-6 t-4 text-xs font-bold text-white bg-black border-2 border-[#fd033f] rounded-full top-[0.1rem] end-4 dark:border-gray-900">{{ $count }}</div>
            </button>
        @else
            <button wire:click='car' data-tooltip-target="tooltip-bookmark" type="button" class="relative inline-flex flex-col items-center justify-center p-4 dark:hover:bg-gray-800 group">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 mb-1 text-white font-extrabold dark:text-gray-400 group-hover:text-black">
                    <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                  </svg>        
                <div class="absolute inline-flex items-center justify-center w-6 h-6 t-4 text-xs font-bold text-white bg-black border-2 border-[#fd033f] rounded-full top-[0.1rem] end-4 dark:border-gray-900">{{ $count }}</div>
            </button>
        @endif

        <!-- Status -->
        @if (request()->routeIs('status-sale'))
            <button wire:click='status_sale' data-tooltip-target="tooltip-home" type="button" class="inline-flex flex-col items-center justify-center p-4 dark:hover:bg-gray-800 group">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 mb-1 text-black font-extrabold">
                    <path fill-rule="evenodd" d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 0 0 4.25 22.5h15.5a1.875 1.875 0 0 0 1.865-2.071l-1.263-12a1.875 1.875 0 0 0-1.865-1.679H16.5V6a4.5 4.5 0 1 0-9 0ZM12 3a3 3 0 0 0-3 3v.75h6V6a3 3 0 0 0-3-3Zm-3 8.25a3 3 0 1 0 6 0v-.75a.75.75 0 0 1 1.5 0v.75a4.5 4.5 0 1 1-9 0v-.75a.75.75 0 0 1 1.5 0v.75Z" clip-rule="evenodd" />
                  </svg>
                  
            </button>
        @else
            <button wire:click='status_sale' data-tooltip-target="tooltip-home" type="button" class="inline-flex flex-col items-center justify-center p-4 dark:hover:bg-gray-800 group">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 mb-1 text-white font-extrabold group-hover:text-black">
                    <path fill-rule="evenodd" d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 0 0 4.25 22.5h15.5a1.875 1.875 0 0 0 1.865-2.071l-1.263-12a1.875 1.875 0 0 0-1.865-1.679H16.5V6a4.5 4.5 0 1 0-9 0ZM12 3a3 3 0 0 0-3 3v.75h6V6a3 3 0 0 0-3-3Zm-3 8.25a3 3 0 1 0 6 0v-.75a.75.75 0 0 1 1.5 0v.75a4.5 4.5 0 1 1-9 0v-.75a.75.75 0 0 1 1.5 0v.75Z" clip-rule="evenodd" />
                  </svg>
            </button>
        @endif

        <!-- profile -->
        @if (request()->routeIs('profile'))
            <button wire:click='profile' data-tooltip-target="tooltip-search" type="button" class="inline-flex flex-col items-center justify-center p-4 dark:hover:bg-gray-800 group">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 mb-1 text-black font-extrabold">
                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                  </svg>
            </button>
        @else
            <button wire:click='profile' data-tooltip-target="tooltip-search" type="button" class="inline-flex flex-col items-center justify-center p-4 dark:hover:bg-gray-800 group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mb-1 text-white font-extrabold dark:text-gray-400 group-hover:text-black">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </button>
        @endif
    </div>
</div>
