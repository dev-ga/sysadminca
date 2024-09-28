<div>
    <div class="flex items-center bg-gray-900">
        <div class="container px-5 mx-auto py-24">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">
                @foreach ($sale as $item)
                    <div class="card w-full h-auto bg-gray-800 rounded-2xl overflow-hidden border-2 border-yellow-300">
                        <div class="card-content p-4 z-10">
                            <div class="flex items-center mb-4">
                                <!-- Generar QR -->
                                <div class="w-20 h-auto rounded-xl shadow-lg mr-3 flex items-center justify-center text-white font-extrabold text-[0.6rem] leading-tight">
                                    {!! QRCode::text($item->sale_code)->setMargin(2)->svg() !!}
                                </div>
                                <div>
                                    <h2 title="SuperApp" class="text-xl font-extrabold text-white truncate">
                                        Ciudad Alternativa
                                    </h2>
                                    <span class="text-xs font-extrabold px-2 py-0.5 rounded-full mt-1 inline-block bg-yellow-300 text-black uppercase">
                                        {{ $item->status->name }}
                                    </span>
                                </div>
                            </div>
        
                            <div class="mb-4">
                                <h3 class="text-md font-extrabold text-white mb-2">Metodo de Envido</h3>
                                <div class="flex flex-wrap -mx-1">
                                    <div class="px-2 py-1 m-0.5 bg-white/10 rounded-full text-sm font-extrabold text-white/70 shadow-sm border border-white/20 transition-all duration-300 hover:bg-white/20">
                                        {{ $item->delivery_method }}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h3 class="text-md font-extrabold text-white mb-2">Metodo de Pago</h3>
                                <div class="flex flex-wrap -mx-1">
                                    <div class="px-2 py-1 m-0.5 bg-white/10 rounded-full text-sm font-extrabold text-white/70 shadow-sm border border-white/20 transition-all duration-300 hover:bg-white/20">
                                        {{ $item->payment_method }}
                                    </div>
                                </div>
                            </div>
                            {{-- {{ $item->saleDetails }} --}}
                            <div class="mb-4">
                                <h3 class="text-md font-extrabold text-white mb-2">Item Asociados</h3>
                                <ul class="text-md text-white/60 grid grid-cols-1 gap-1">
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
                            <div class="flex justify-between items-center space-x-2">
                                <button class="flex-1 bg-black text-white rounded-lg px-3 py-2 text-xs font-medium transition duration-300 ease-in-out hover:bg-[#fd033f] flex items-center justify-center">
                                    <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                                    </svg>
                                    Cancelar Orden
                                </button>
                                <button class="flex-1 bg-black text-white rounded-lg px-3 py-2 text-xs font-medium transition duration-300 ease-in-out hover:bg-green-700 flex items-center justify-center">
                                    <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                                    </svg>
                                    Asesor de Venta
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>  
        </div>
    </div>
</div>

