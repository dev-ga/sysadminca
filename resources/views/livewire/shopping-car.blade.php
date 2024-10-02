<div>
    <div class="flex items-center bg-gray-900">
        <div class="container px-5 mx-auto py-24">
            @if ($total_item_car == 0)
            <div class="text-center mt-10">
                <div class="flex justify-center items-center w-[15rem] mx-auto text-gray-400 opacity-25">
                    <img src="{{ asset('image/car-empty.png') }}" alt="">
                </div>
                <p class="mt-1 text-sm text-gray-500">Usted! no tiene productos en su carrito de compra, debe buscarlo y anadirlo desde el buscador de productos</p>
            </div>
            @endif
            {{-- grid de productos --}}
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2">
                @foreach ($item_car as $item)
                    <div class="flex flex-col">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                <span class="text-xl text-gray-500">{{ $item->inventory->sku }}</span>
                            </div>
                            <div wire:click='delete({{ $item->id }})' class="flex items-center space-x-1 rtl:space-x-reverse">
                                <svg class="w-6 h-6 text-[#fd033f]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                  </svg>                                  
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 dark:text-white w-full bg-gray-800 dark:bg-neutral-900 py-5 px-1 rounded-3xl shadow-md">
                            <div class="flex justify-between w-full">
                                <div class="flex justify-start items-center">
                                    <div class="p-1">
                                        <img class="w-20" src="https://static.vecteezy.com/system/resources/thumbnails/030/761/291/small/modern-sport-sneakers-blue-color-ai-generative-free-png.png" alt="product image" />
                                    </div>
                                    <div class="py-2 px-1">
                                        <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                            <span class="text-sm text-gray-500">{{ $item->inventory->code }}</span>
                                        </div>
                                        <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                            <span class="text-sm text-gray-500">Talla:</span>
                                            <span class="text-sm text-gray-500">{{ $item->inventory->size }}</span>
                                        </div>
                                        <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                            <span class="text-sm text-gray-500">Cantidad:</span>
                                            <span class="text-sm text-gray-500">{{ $item->quantity }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 my-auto">
                                    <div class="text-3xl text-white font-extrabold">
                                        ${{ round($item->inventory->price) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($total_item_car != 0)
                    <div class="flex flex-col mt-4">
                        <div class="flex flex-col gap-2 dark:text-white w-full bg-black border border-[#fd033f] py-5 px-1 rounded-3xl shadow-md">
                            <div class="flex justify-between w-full">
                                <div class="flex justify-start items-center">
                                    <div class="py-2 px-1">
                                        <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                            <span class="text-sm text-gray-300">Facturacion:</span>
                                        </div>
                                        <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                            <span class="text-sm text-gray-300">Total de Articulos:</span>
                                            <span class="text-sm text-gray-300">{{ ($total_item_car > 0) ? $total_item_car : 0 }}</span>
                                        </div>
                                        <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                            <span class="text-sm text-gray-300">BCV:</span>
                                            <span class="text-sm text-gray-300">Bs. {{ number_format(($bcv), 2, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 mt-auto">
                                    <div class="flex flex-col text-sm text-white bg-black">
                                        <span class="text-right font-extrabold text-gray-300">Total($)= ${{ $total_pay }}</span>
                                        <span class="text-right font-extrabold text-gray-300">Total(Bs.)= {{ number_format(($total_pay_bsd), 2, ',', '.') ? number_format(($total_pay_bsd), 2, ',', '.') : 0.00 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end items-center">
                        <button wire:click='pay_sale' type="button" class="flex justify-center text-white text-end w-full md:w-48 bg-[#fd033f] hover:bg-black/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-extrabold rounded-lg text-sm px-2 py-2.5 items-end dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40 me-2 mt-4">
                            {{-- <svg class="w-4 h-4 me-2 -ms-1" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="bitcoin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M504 256c0 136.1-111 248-248 248S8 392.1 8 256 119 8 256 8s248 111 248 248zm-141.7-35.33c4.937-32.1-20.19-50.74-54.55-62.57l11.15-44.7-27.21-6.781-10.85 43.52c-7.154-1.783-14.5-3.464-21.8-5.13l10.93-43.81-27.2-6.781-11.15 44.69c-5.922-1.349-11.73-2.682-17.38-4.084l.031-.14-37.53-9.37-7.239 29.06s20.19 4.627 19.76 4.913c11.02 2.751 13.01 10.04 12.68 15.82l-12.7 50.92c.76 .194 1.744 .473 2.829 .907-.907-.225-1.876-.473-2.876-.713l-17.8 71.34c-1.349 3.348-4.767 8.37-12.47 6.464 .271 .395-19.78-4.937-19.78-4.937l-13.51 31.15 35.41 8.827c6.588 1.651 13.05 3.379 19.4 5.006l-11.26 45.21 27.18 6.781 11.15-44.73a1038 1038 0 0 0 21.69 5.627l-11.11 44.52 27.21 6.781 11.26-45.13c46.4 8.781 81.3 5.239 95.99-36.73 11.84-33.79-.589-53.28-25-65.99 17.78-4.098 31.17-15.79 34.75-39.95zm-62.18 87.18c-8.41 33.79-65.31 15.52-83.75 10.94l14.94-59.9c18.45 4.603 77.6 13.72 68.81 48.96zm8.417-87.67c-7.673 30.74-55.03 15.12-70.39 11.29l13.55-54.33c15.36 3.828 64.84 10.97 56.85 43.03z"></path></svg> --}}
                            <svg class="w-6 h-6 me-2 -ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M16.5 15v1.5m0 0V18m0-1.5H15m1.5 0H18M3 9V6a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v3M3 9v6a1 1 0 0 0 1 1h5M3 9h16m0 0v1M6 12h3m12 4.5a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z"/>
                              </svg>
                            Pagar
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

