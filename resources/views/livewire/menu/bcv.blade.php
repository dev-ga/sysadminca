<div>
    <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="flex overflow-y-auto overflow-x-hidden justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class=" p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class=" bg-black rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-start p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <div class="flex justity-center items-center">
                        <img class="w-20 h-auto" src="{{ asset('image/logo_bcv_2.png') }}" alt="">
                    </div>
                    <div class="text-white p-3">
                        BANCO CENTRAL DE VENEZUELA
                    </div>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                        <div>
                            <label for="value" class="block mb-2 text-sm font-medium text-white">TASA:</label>
                            <input wire:model='value' type="value" name="value" id="value" class="bg-gray-50 border border-[#fd033f] text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                            <x-input-error :messages="$errors->get('value')" class="mt-1" />
                        </div>
                        <button wire:click='update_bcv' type="submit" class=" mt-4 w-full text-white bg-[#fd033f] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Actualizar tasa</button>
                </div>
            </div>
        </div>
    </div>
</div>

