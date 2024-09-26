<div>
    <div class="flex items-center bg-gray-900">
        <div class="container max-w-6xl px-5 mx-auto py-24">
            {{-- grid de productos --}}
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2">
                @foreach ($item_car as $item)
                    <div class="flex flex-col">
                        <div class="flex justify-end items-center">
                        Eliminar
                        </div>
                        <div class="flex flex-col gap-2 dark:text-white w-full bg-gray-800 dark:bg-neutral-900 py-5 px-1 rounded-3xl shadow-md hover:scale-105 hover:duration-150 duration-150">
                            <div class="flex justify-between w-full">
                                <div class="flex justify-start items-center">
                                    <div class="p-1">
                                        <img class="w-20" src="https://static.vecteezy.com/system/resources/thumbnails/030/761/291/small/modern-sport-sneakers-blue-color-ai-generative-free-png.png" alt="product image" />
                                    </div>
                                    <div class="py-2 px-1">
                                        <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                            <span class="text-sm text-gray-500">{{ $item->inventory->sku }}</span>
                                        </div>
                                        <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                            <span class="text-sm text-gray-500">Talla:</span>
                                            <span class="text-sm text-gray-500">{{ $item->inventory->size }}</span>
                                        </div>
                                        <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                            <span class="text-sm text-gray-500">codigo:</span>
                                            <span class="text-sm text-gray-500">{{ $item->inventory->code }}</span>
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
            </div>
        </div>
        <footer class="fixed bottom-0 flex flex-col items-center text-center w-full p-4 block mb-20">
            <div class="flex items-center justify-center mt-6 w-full">
                <a class="w-full" href="{{ route('login-costumer') }}">
                    <button class="flex justify-center w-full h-full rounded-3xl border border-[#fd033f] py-4 px-6 mt-1 text-md items-center sm:text-center font-bold text-white shadow-sm hover:bg-[#fd033f] uppercase">
                        <span class="text-center font-extrabold items-center shadow-2xl">Siguiente</span>
                    </button>
                </a>
            </div>
        </footer>
    </div>
</div>

