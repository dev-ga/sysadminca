<div>
    <div class="p-5">
        @livewire('notifications')
        <h1 class="text-xl mb-6 font-bold text-white uppercase">Modulo de cierre diario</h1>
        <div class="flex justify-between mt-auto">
            <div class="grid md:grid-cols-2 lg:gap-4 mt-5 w-full">
                {{-- Referencia --}}
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-white dark:text-white">Descripcion del Gasto</label>
                        <input wire:model="description" type="text" id="default-input" class="bg-black border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Eje: Papel sanitario">
                    <x-input-error :messages="$errors->get('description')" class="mt-1" />
                    </div>
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-white dark:text-white">Tipo de pago</label>
                        <select wire:model="payment_method" id="small" class="block w-full p-2 mb-1 text-sm text-white border border-gray-300 rounded-lg bg-black focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>seleccione...!</option>
                            <option value="usd">USD</option>
                            <option value="bsd">BSD</option>
                        </select>
                    <x-input-error :messages="$errors->get('payment_method')" class="mt-1" />
                    </div>
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-white dark:text-white">Monto en USD/BSD</label>
                        <input wire:model="amount" type="text" id="default-input" class="bg-black border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Eje: 1256.90">
                    <x-input-error :messages="$errors->get('amount')" class="mt-1" />
                    </div>
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-white dark:text-white">Referencia de Gasto</label>
                        <input wire:model="reference" type="text" id="default-input" class="bg-black border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="000456">
                    </div>
                {{-- montos --}}
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit" wire:click.prevent="upload_bill()" class="flex justify-end rounded-md border border-transparent bg-[#fd033f] py-4 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                    <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="upload_bill" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    <span>Cargar Gasto</span>
                </button>
            </div>
            @livewire('tables.table-bill')
        </div>
    </div>
</div>
