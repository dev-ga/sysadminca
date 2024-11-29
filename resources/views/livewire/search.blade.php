<div>
    <div class="flex items-center bg-gray-900">
        <div class="container max-w-6xl px-5 mx-auto py-16">
            
            @if(count($books) == 0)
            {{-- Productos vacios --}}
            <div class="text-center mt-52">
                <div class="flex justify-center items-center w-[15rem] mx-auto text-gray-400 opacity-25">
                    <img src="{{ asset('image/search-empty.png') }}" alt="">
                </div>
                <h3 class="mt-2 text-sm font-semibold text-gray-900">No projects</h3>
                <p class="mt-1 text-sm text-gray-500">Ups! Lo sentimos pero no pudimos encontrar nada referente a su busqueda.<br> Por favor vuelva a intentar</p>
            </div>
            @else

            <div class="mt-10">
                <div class="grid grid-cols-1 {{ ($count == 1) ? 'md:grid-cols-1 lg:grid-cols-1' : 'md:grid-cols-2 lg:grid-cols-2' }} gap-2 items-center mx-auto mt-4">
                @foreach ($books as $item)
                    <div class="weather flex min-h-[10em] min-w-[16em] flex-col items-center justify-between gap-[0.5em] rounded-[1.5em] bg-gray-200 px-[1em] py-[0.5em] font-nunito text-black shadow-[0px_4px_16px_0px_#222]">
                        <div class="flex h-fit w-full items-center justify-start gap-[1em]">
                            <img class="w-2/5 h-1/2 rounded-[1.5em]" src="{{ $item->image }}" onclick="Livewire.dispatch('openModal', { component: 'modal-image', arguments: { inventory: {{ $item->id }} }})">
                            <span class="h-[4em] w-[0.5px] rounded-full bg-[#fd033f]"></span>
                            <div class="flex flex-col items-start justify-center">
                                <p class="text-[0.75rem] font-light">SKU: {{ $item->sku }}</p>
                                <p class="text-[1.5em] font-semibold">${{ round($item->price) }}</p>
                            </div>
                        </div>
                        
                        <div class="flex h-fit w-full items-center justify-between">
                            <div class="flex h-fit w-full flex-col items-start justify-between text-[0.75em]">
                                <div class="flex flex-row items-center justify-center gap-[0.5em] p-[0.25em]">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                                    </svg>
                                    
                                    <span class="h-[0.5em] w-[1px] rounded-full bg-[#fd033f]"></span>
                                    <p>Disponible:</p>
                                    <span class="h-[0.5em] w-[1px] rounded-full bg-[#fd033f]"></span>
                                    <p>{{ $item->quantity }}</p>
                                </div>
                                <div class="flex flex-row items-center justify-center gap-[0.5em] p-[0.25em]">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.045 3.007 12.31 3a1.965 1.965 0 0 0-1.4.585l-7.33 7.394a2 2 0 0 0 0 2.805l6.573 6.631a1.957 1.957 0 0 0 1.4.585 1.965 1.965 0 0 0 1.4-.585l7.409-7.477A2 2 0 0 0 21 11.479v-5.5a2.972 2.972 0 0 0-2.955-2.972Zm-2.452 6.438a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                                    </svg>
                                    <span class="h-[0.5em] w-[1px] rounded-full bg-[#fd033f]"></span>
                                    <p>Talla:</p>
                                    <span class="h-[0.5em] w-[1px] rounded-full bg-[#fd033f]"></span>
                                    <p>{{ $item->size }}</p>
                                </div>
                                <div class="flex flex-row items-center justify-center gap-[0.5em] p-[0.25em]">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M5.617 2.076a1 1 0 0 1 1.09.217L8 3.586l1.293-1.293a1 1 0 0 1 1.414 0L12 3.586l1.293-1.293a1 1 0 0 1 1.414 0L16 3.586l1.293-1.293A1 1 0 0 1 19 3v18a1 1 0 0 1-1.707.707L16 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L12 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L8 20.414l-1.293 1.293A1 1 0 0 1 5 21V3a1 1 0 0 1 .617-.924ZM9 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="h-[0.5em] w-[1px] rounded-full bg-[#fd033f]"></span>
                                    <p>Color:</p>
                                    <span class="h-[0.5em] w-[1px] rounded-full bg-[#fd033f]"></span>
                                    <p>{{ $item->color }}</p>
                                </div>
                            </div>
                            <div wire:click='add_item({{ $item->id }})' class="cursor-pointer text-white bg-black hover:bg-[#fd033f] hover:text-white hover:font-extrabold focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Añadir
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-5 px-7">
            {{ $books->links() }}
        </div>
        @endif
        <div class="h-10"></div>
    </div>
</div>



</div>

