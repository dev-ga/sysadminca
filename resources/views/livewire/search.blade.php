<div>
    <div class="flex items-center bg-gray-900">
        <div class="container max-w-6xl px-5 mx-auto py-16">
            <div class="flex flex-col justify-center items-center w-full pt-3 pb-3 fixed left-0 bg-gray-900">
                <div class="flex flex-col items-center justify-start">
                    <h1 class="text-xl font-bold text-white">Buscador de Productos</h1>
                    {{-- <p class="text-xs text-center text-gray-300">Introduzca el codigo del articulo o los ultimos 4 digitos</p> --}}
                </div>
                <div class="grid grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-2 items-center mx-auto mt-4 px-5">   
                    <div class="w-full">
                        <label class="text-sm" for="">Categorias</label>
                        <select wire:model.live='categoryId' id="small" class="block w-full p-2 text-sm text-white border border-[#fd033f] rounded-lg bg-black focus:ring-[#fd033f] focus:border-[#fd033f] ps-5">
                            <option selected></option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="w-full">
                        <label class="text-sm" for="">Subcategorias</label>
                        <select wire:model.live='subCategoryId' id="small" class="block w-full p-2 text-sm text-white border border-[#fd033f] rounded-lg bg-black focus:ring-[#fd033f] focus:border-[#fd033f] ps-5">
                            <option selected></option>
                            @foreach ($subCategories as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="w-full">
                        <label class="text-sm" for="">Tallas</label>
                        <select wire:model.live='tallaId' id="small" class="block w-full p-2 text-sm text-white border border-[#fd033f] rounded-lg bg-black focus:ring-[#fd033f] focus:border-[#fd033f] ps-5">
                            <option selected></option>
                            @foreach ($tallas as $value)
                                <option value="{{ $value->size }}">{{ $value->size }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="text-sm" for="">Color</label>
                        <select wire:model.live='colorId' id="small" class="block w-full p-2 text-sm text-white border border-[#fd033f] rounded-lg bg-black focus:ring-[#fd033f] focus:border-[#fd033f] ps-5">
                            <option selected></option>
                            @foreach ($color as $value)
                                <option class="uppercase" value="{{ $value->color }}">{{ $value->color }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
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
                <div class="mt-44">
                    <div class="grid grid-cols-1 {{ ($count == 1) ? 'md:grid-cols-1 lg:grid-cols-1' : 'md:grid-cols-2 lg:grid-cols-2' }} gap-2 items-center mx-auto mt-4 px-5">
                        @foreach ($books as $item)
                        {{-- Productos --}}
                        <div class="w-full bg-white border border-gray-900 rounded-lg dark:bg-gray-800 dark:border-gray-700 shadow-inner mt-2">
                            <div>
                                <img class="p-8 h-[20rem] rounded-t-lg mx-auto" src="{{ $item->image }}"  alt="product image" onclick="Livewire.dispatch('openModal', { component: 'modal-image', arguments: { inventory: {{ $item->id }} }})" />
                            </div>
                            <div class="px-5 pb-5">
                                <div class="flex justify-between items-center">
                                    <div class="">
                                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $item->sku }}</h5>
                                    </div>
                                    
                                    
                                    {{-- <div class="w-[10rem] mt-auto mb-auto">
                                        <x-number  id="{{ $item->id }}" wire:model.live="quantity.{{ $item->id }}" />
                                    </div> --}}

                                    <!-- Input Number -->
                                    <div>
                                        <div class="flex items-center mx-auto">
                                            <span class="text-sm text-gray-500 mr-1">Cantidad:</span>
                                            <input id="{{ $item->id }}" wire:model.live="quantity.{{ $item->id }}" type="text" class="inline-flex items-center justify-center border rounded-md border-gray-200 w-14 h-10 text-sm font-light text-center focus:border-[#fd033f] text-black">
                                            {{-- <input id="{{ $item->id }}" wire:model.live="quantity.{{ $item->id }}" type="text" name="quantity.{{ $item->id }}" class="block w-[4rem] rounded-md border-0 py-1.5 pr-10 text-gray-900 text-center ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"> --}}
                                        </div>
                                    </div>
                                    <!-- End Input Number -->

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
                                    <span class="text-4xl font-bold text-black dark:text-white">${{ round($item->price) }}</span>
                                    <div wire:click='add_item({{ $item->id }})' class="cursor-pointer text-white bg-black hover:bg-[#fd033f] hover:text-white hover:font-extrabold focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> + Añadir</div>
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
    {{-- CSS: 'backdrop-blur-3xl' --}}
    


</div>



