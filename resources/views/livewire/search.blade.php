<div>
    <div class="flex items-center bg-gray-900">
        <div class="container max-w-6xl px-5 mx-auto py-16">
            <div class="flex flex-col justify-center items-center w-full py-8 fixed left-0 z-50 bg-gray-900">
                <div class="flex flex-col items-center justify-start">
                    <h1 class="text-xl font-bold text-white">Buscador de Productos</h1>
                    <p class="text-xs text-center text-gray-300">Introduzca el codigo del articulo o los ultimos 4 digitos</p>
                </div>
                <div class="flex items-center max-w-sm mx-auto mt-4">   
                    <div class="w-full">
                        <input type="text" wire:model.live='search' class="bg-black border border-white text-white text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5" placeholder="CA-32569076" required />
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                    <button type="submit" wire:click='search_item' class="p-2.5 ms-2 text-sm font-medium text-white bg-[#fd033f] rounded-lg border border-[#fd033f] hover:text-black">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </div>

            @if(count($books) == 0)
            {{-- Productos vacios --}}
            <div class="text-center mt-12">
                <div class="flex justify-center items-center w-[15rem] mx-auto text-gray-400 opacity-25">
                    <img src="{{ asset('image/search-empty.png') }}" alt="">
                </div>
                <h3 class="mt-2 text-sm font-semibold text-gray-900">No projects</h3>
                <p class="mt-1 text-sm text-gray-500">Usted! no tiene productos en su busqueda!</p>
            </div>
            @else
                <div class="mt-44">
                    @foreach ($books as $item)
                        <div class="flex flex-col items-center justify-center mt-4">
                        {{-- Productos --}}
                            <div class="w-full max-w-sm bg-gray-200 border border-gray-900 rounded-lg dark:bg-gray-800 dark:border-gray-700 shadow-inner">
                                <a href="#">
                                    <img class="p-8 rounded-t-lg mx-auto" src="https://static.vecteezy.com/system/resources/thumbnails/030/761/291/small/modern-sport-sneakers-blue-color-ai-generative-free-png.png" alt="product image" />
                                </a>
                                <div class="px-5 pb-5">
                                    <div class="flex justify-between items-center">
                                        <div class="">
                                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $item->sku }}</h5>
                                        </div>
                                        
                                        <div class="w-[10rem] mt-auto mb-auto">
                                            <x-number  id="{{ $item->id }}" wire:model.live="quantity.{{ $item->id }}" />
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center mt-2.5 mb-5">
                                        <div>
                                            <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                                <span class="text-sm text-gray-500">Disponible:</span>
                                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">{{ $item->quantity }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                                <span class="text-sm text-gray-500">Talla:</span>
                                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">{{ $item->size }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                                <span class="text-sm text-gray-500">Color:</span>
                                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">{{ $item->color }}</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ $item->code }}</span>
                                        <div wire:click='add_item({{ $item->id }})' class="cursor-pointer text-black bg-white hover:bg-[#fd033f] hover:text-white hover:font-extrabold focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> + Añadir</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</div>



