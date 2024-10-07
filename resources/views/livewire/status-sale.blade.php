<div>
    <div class="flex items-center bg-gray-900">
        <div class="container px-5 mx-auto py-24">
            @if(count($sale) == 0)
            {{-- Productos vacios --}}
            <div class="text-center mt-12">
                <div class="flex justify-center items-center w-[15rem] mx-auto text-gray-400 opacity-25">
                    <img src="{{ asset('image/search-empty.png') }}" alt="">
                </div>
                <h3 class="mt-2 text-sm font-semibold text-gray-900">No projects</h3>
                <p class="mt-1 text-sm text-gray-500">Usted! no tiene pedidos pendiente por cancelar o por retirar</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">
                @foreach ($sale as $item)
                    <div id="accordion-open-{{ $item->id }}" data-accordion="open" data-active-classes="bg-{{ $item->status->color }} border-0">
                        <h2 id="accordion-open-heading-1-{{ $item->id }}">
                            <button type="button" class="flex items-center justify-between w-full p-5 border  border-[#fd033f] font-medium text-white bg-black  rounded-3xl  focus:bg-{{ $item->status->color }} hover:bg-{{ $item->status->color }} hover:border-0  gap-3" data-accordion-target="#accordion-open-body-1-{{ $item->id }}" aria-expanded="false" aria-controls="accordion-open-body-1-{{ $item->id }}">
                                <div class="flex items-center">
                                    <svg class="w-7 h-7 me-2 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"/>
                                    </svg>
                                    {{ $item->sale_code }}
                                </div>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        {{-- Contenido del Acordion --}}
                        <div id="accordion-open-body-1-{{ $item->id }}" class="hidden" aria-labelledby="accordion-open-heading-1-{{ $item->id }}">
                            <div class="p-5">
                                <div class="card w-full h-auto bg-gray-800 rounded-2xl overflow-hidden border-2 border-{{ $item->status->color }}">
                                    <div class="card-content p-4 z-10">
                                        <div class="flex items-center mb-4">
                                            <div>
                                                <h2 title="SuperApp" class="text-sm font-extrabold text-white truncate">
                                                    Estatus de Orden:
                                                </h2>
                                                <span class="text-xs font-extrabold px-2 py-0.5 rounded-full mt-1 inline-block bg-{{ $item->status->color }} text-white uppercase">
                                                    {{ $item->status->name }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <h3 class="text-sm font-extrabold text-white">Metodo de Envido</h3>
                                            <div class="flex flex-wrap -mx-1">
                                                <div class="px-2 m-0.5 bg-white/10 rounded-full text-xs font-extrabold text-white/70 shadow-sm border border-white/20 transition-all duration-300 hover:bg-white/20 uppercase">
                                                    {{ $item->delivery_method }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <h3 class="text-md font-extrabold text-white">Metodo de Pago</h3>
                                            <div class="flex flex-wrap -mx-1">
                                                <div class="flex flex-wrap -mx-1">
                                                    <div class="px-2 m-0.5 bg-white/10 rounded-full text-xs font-extrabold text-white/70 shadow-sm border border-white/20 transition-all duration-300 hover:bg-white/20 uppercase">
                                                        {{ $item->payment_method }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- {{ $item->saleDetails }} --}}
                                        <div class="mb-3">
                                            <h3 class="text-md font-extrabold text-white">Item Asociados</h3>
                                            <ul class="text-sm text-white/60 font-extrabold grid grid-cols-1 gap-1">
                                                @foreach ($item->saleDetails as $value)
                                                    <li class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" class="w-3 h-3 mr-1 text-white/70">
                                                            <path d="M5 13l4 4L19 7" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                                                        </svg>
                                                        <span title="Dark Mode" class="truncate">{{ $value->sku }} - Cantidad: {{ $value->quantity }} - Talla: {{ $value->size }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        {{-- Botones --}}
                                        <div class="flex justify-between items-center space-x-2">
                                            <button data-modal-target="small-modal" data-modal-toggle="small-modal" class="flex-1 bg-black text-white rounded-lg px-3 py-2 text-xs font-medium transition duration-300 ease-in-out hover:bg-[#fd033f] flex items-center justify-center uppercase">
                                                <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                                                </svg>
                                                Ver qr
                                            </button>
                                            <button class="flex-1 bg-black text-white rounded-lg px-3 py-2 text-xs font-medium transition duration-300 ease-in-out hover:bg-green-700 flex items-center justify-center">
                                                <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                                                </svg>
                                                Asesor de Venta
                                            </button>`
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Small Modal -->
                    <div id="small-modal" tabindex="-1" class="fixed top-0 left-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-black rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->

                                <!-- Modal body -->
                                <div class="p-4 md:p-5 space-y-4">
                                    <div class="text-center mt-10">
                                        <div class="flex justify-center items-center w-[15rem] mx-auto text-gray-400">
                                            <img src="{{ asset('storage/'.$item->sale_code.'.png') }}" alt="">
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">QR - Para uso de seguridad</p>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="flex w-full items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="small-modal" type="button" class="w-full py-2.5 px-5 ms-3 text-md font-extrabold text-white focus:outline-none bg-black rounded-lg border border-[#fd033f] hover:bg-[#fd033f]">Cerrar</button>
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