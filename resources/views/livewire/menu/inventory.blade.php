<div>
    <div class="p-5">
        @livewire('notifications')
        <h1 class="text-xl mb-6 font-bold text-black uppercase">Modulo de Carga de Inventario</h1>
        <div class="w-full mt-2 ">
            <div class="flex justify-between items-center justify-start mb-1">
                <h1 class="text-sm text-black">DESEA REALICAR LA CARGA POR BULTO?</h1>

                <label class="relative inline-flex items-center cursor-pointer">
                    <input wire:model.live='res' type="checkbox" value="" class="sr-only peer">
                    <div class="group peer ring-0 bg-[#fd033f]  rounded-full outline-none duration-100 after:duration-200 w-16 h-8  
                    shadow-md peer-checked:bg-emerald-500  peer-focus:outline-none   
                    after:rounded-full 
                    after:absolute 
                    after:bg-black 
                    after:outline-none 
                    after:h-6 
                    after:w-6 
                    after:top-1 
                    after:left-1 
                    after:-rotate-180 
                    after:flex 
                    after:justify-center 
                    after:items-center 
                    peer-checked:after:translate-x-8 
                    peer-hover:after:scale-95 
                    peer-checked:after:rotate-0">
                    </div>
                </label>
            </div>
        </div>
        <div class="flex justify-between mt-auto">
            <div class="grid md:grid-cols-4 lg:gap-4 mt-5 w-full">
                {{-- Referencia --}}
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-black dark:text-white">Sku</label>

                        <input wire:model="sku" type="text" id="default-input" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Eje: QUEEN-O1">

                        <x-input-error :messages="$errors->get('sku')" class="mt-1" />
                    </div>

                {{-- montos --}}
                </div>
            </div>
            <div class="grid md:grid-cols-4 lg:gap-4 mt-8 w-full">
                {{-- Referencia --}}
                <div class="w-full">
                    <label for="default-input" class="block mb-2 text-sm font-medium text-black dark:text-white">Categoria</label>

                    <select wire:model.live='categoryId' id="default-input" class="block w-full p-2 mb-1 text-sm border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"">
                        <option selected>seleccione...!</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                      </select>
                <x-input-error :messages="$errors->get('categoryId')" class="mt-1" />
                </div>
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-black dark:text-white">Subcategoria</label>

                        <select wire:model.live='subCategoryId' id="default-input" class="block w-full p-2 mb-1 text-sm border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"">
                            <option selected>seleccione...!</option>
                            @foreach ($subCategories as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                          </select>
                    <x-input-error :messages="$errors->get('subCategoryId')" class="mt-1" />
                    </div>
                    <div class="w-full {{ ($res == 0) ? 'display' : 'hidden' }}">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-black dark:text-white">Talla</label>

                        <input wire:model="size" type="text" id="default-input" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Eje: 35 - 5.5">
                        <x-input-error :messages="$errors->get('size')" class="mt-1" />
                    </div>
                    <div class="w-full {{ ($res == 1) ? 'display' : 'hidden' }}">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-black dark:text-white">Regla de tallas</label>

                        <select wire:model.live='array_size' id="default-input" class="block w-full p-2 mb-1 text-sm border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"">
                            <option selected>seleccione...!</option>
                            <option value="completa">Completa (35....40)</option>
                            <option value="medias">Tallas Media (5.5....10)</option>
                            <option value="medias2">Tallas Media incluye el (5) (5, 5.5....10)</option>
                          </select>
                        <x-input-error :messages="$errors->get('array_size')" class="mt-1" />
                    </div>
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-black">Color</label>

                        <input wire:model="color" type="text" id="default-input" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Eje: negro, blanco, fucsia">
                        <x-input-error :messages="$errors->get('color')" class="mt-1" />
                    </div>
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-black dark:text-white">Modelo</label>

                        <input wire:model="model" type="text" id="default-input" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Eje: tipo airMax">
                        <x-input-error :messages="$errors->get('model')" class="mt-1" />
                    </div>
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-black dark:text-white">Material</label>

                        <input wire:model="material" type="text" id="default-input" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Eje: patente, tela">
                        <x-input-error :messages="$errors->get('material')" class="mt-1" />
                    </div>
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-black dark:text-white">Precio($)</label>

                        <input wire:model="price" type="text" id="default-input" class="bg-white border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Eje: 40, 35">
                        <x-input-error :messages="$errors->get('price')" class="mt-1" />
                    </div>
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-black dark:text-white">Cantidad</label>

                        <input wire:model="quantity" type="text" id="default-input" class="bg-white border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Eje: 1, 3, 2">
                        <x-input-error :messages="$errors->get('quantity')" class="mt-1" />
                    </div>
                    <!-- Imagen -->
                    {{-- <div class="w-full">
                        <div class="w-full">
                            <div class="flex items-center justify-center w-full">
                                <!-- Preview de la imagen -->
                                @if ($image)
                                <div class="flex flex-col items-center justify-center mt-5">
                                    <div wire:click='delete_image' class="flex ml-auto">
                                        <svg class="w-6 h-6 text-[#fd033f]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                    </div>
                                    <img class="w-1/2 h-auto" src="{{ $image->temporaryUrl() }}">
                                </div>
                                @endif
                                <!-- Carga de la imagen y spinner -->
                                <div class="flex flex-col items-center justify-center mt-5 {{ ($image != '') ? 'hidden' : '' }}">
                                    <div class="p-1">
                                        <label class="block mb-2 text-sm font-medium text-gray-300" for="file_input">Cargar Comprobante de pago</label>
                                            <input wire:model='image' class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="image" type="file">
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG(MAX. 1024MB).</p>
                                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                    </div>
                                    <div class="p-1">
                                        <div wire:loading wire:target="image">
                                            <div class="flex-col gap-4 w-full flex items-center justify-center">
                                                <div class="w-14 h-14 border-4 border-transparent text-[#fd033f] text-4xl animate-spin flex items-center justify-center border-t-[#fd033f] rounded-full">
                                                    <div class="w-10 h-10 border-4 border-transparent text-black text-2xl animate-spin flex items-center justify-center border-t-black rounded-full"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" wire:click.prevent="upload_inventory()" class="flex justify-end rounded-md border border-transparent bg-[#fd033f] py-4 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                        <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="upload_inventory" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        <span>Cargar Producto</span>
                    </button>
                </div>
            </div>
            <div class="mb-10">
                @livewire('tables.table-product')
            </div>
        </div>
    </div>
</div>
