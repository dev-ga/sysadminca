<div>
    <div class="p-5">
        @livewire('notifications')
        <h1 class="text-xl mb-6 font-bold text-white uppercase">Modulo de cierre diario</h1>
        <div class="flex justify-between mt-auto">
            <div class="grid md:grid-cols-3 md:gap-6 mt-5 w-full">
                {{-- Referencia --}}
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-white dark:text-white">Ref. Debito</label>
                        <input wire:model="ref_debito" type="text" id="default-input" class="bg-black border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nro. Lote 000456">
                    </div>
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-white dark:text-white">Ref. Credito</label>
                        <input wire:model="ref_credito" type="text" id="default-input" class="bg-black border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nro. Lote 000456">
                    </div>
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-white dark:text-white">Ref. Visa/Master</label>
                        <input wire:model="ref_visaMaster" type="text" id="default-input" class="bg-black border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nro. Lote 000456">
                    </div>
                {{-- montos --}}
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-white dark:text-white">Monto Debito</label>
                        <input wire:model="amount_debito" type="text" id="default-input" class="bg-black border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  placeholder="Ejemplo: 1.2345,89">
                    </div>
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-white dark:text-white">Monto Credito</label>
                        <input wire:model="amount_credito" type="text" id="default-input" class="bg-black border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ejemplo: 456,90">
                    </div>
                    <div class="w-full">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-white dark:text-white">Monto Visa/Master Debito</label>
                        <input wire:model="amount_visaMaster" type="text" id="default-input" class="bg-black border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ejemplo: 1.456,00">
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit" wire:click.prevent="daily_closing()" class="flex justify-end rounded-md border border-transparent bg-[#fd033f] py-4 px-4 text-sm font-bold text-white shadow-sm hover:bg-check-green">
                    <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="daily_closing" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    <span>Ejecutar Cierre Diario</span>
                </button>
            </div>
            @livewire('tables.table-daily-closing')
        </div>
    </div>
</div>
