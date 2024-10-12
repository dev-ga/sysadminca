<div>
    @livewire('notifications')
    <div class="flex justify-between p-5">
        <div>
            <h1 class="text-lg font-bold text-white uppercase">Facturacion Ciudad Alternativa</h1>
        </div>
        <div class="text-white">
            @if($hidden_table_inventory == '')
                <svg wire:click='hidden()' class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M15 7a2 2 0 1 1 4 0v4a1 1 0 1 0 2 0V7a4 4 0 0 0-8 0v3H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V7Zm-5 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                </svg>
            @endif
            @if($hidden_table_inventory == 'hidden')
                <svg wire:click='show()' class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                </svg>
            @endif
        </div>
    </div>
    <div class="{{ $hidden_table_inventory }}">
        @livewire('tables.table-inventory')
    </div>
    {{-- @livewire('tables.table-sale-detail') --}}
    <div class="grid grid-cols-4 gap-2">
        <div class="col-span-2 w-full max-h-full">
            @livewire('tables.table-pre-billing')
        </div>
        {{-- CAJA --}}
        <div class="p-2 col-span-2 w-full">
            <div class="w-full max-h-full p-2 border border-gray-500 rounded-lg shadow ">
                <h2 class="text-xl font-bold text-white py-4 px-2">
                    Facturacion
                </h2>
                <div class="space-y-4 p-2">
                    {{-- Metodo de pago Prepagado --}}
                    <div class="grid grid-cols-1 gap-2">
                        <div class="px-1">
                            <label for="small" class="block mb-2 text-sm font-medium text-white">Empleado</label>
                            <select id="small" class="block w-full p-2 mb-1 text-sm text-white border border-gray-300 rounded-lg bg-black focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected></option>
                                @foreach ($employees as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="px-1">
                            <label for="small" class="block mb-2 text-sm font-medium text-white">Metodo de Pago($)</label>
                            <select id="small" class="block w-full p-2 mb-1 text-sm text-white border border-gray-300 rounded-lg bg-black focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected></option>
                                @foreach ($method_pay_usd as $item)
                                    <option value="{{ $item->description }}">{{ $item->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="px-1">
                            <label for="small" class="block mb-2 text-sm font-medium text-white">Metodo de Pago(Bs.)</label>
                            <select id="small" class="block w-full p-2 mb-1 text-sm text-white border border-gray-300 rounded-lg bg-black focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected></option>
                                @foreach ($method_pay_bsd as $item)
                                    <option value="{{ $item->description }}">{{ $item->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="px-2">
                            <label for="default-input" class="block mb-2 text-sm font-medium text-white dark:text-white">Monto($)</label>
                            <input type="text" id="default-input" class="bg-black border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00">
                            {{-- <x-input wire:keydown.enter="calculo($event.target.value)" wire:model.live="valor_uno" placeholder="0.00"/> --}}
                        </div>
                        <div class="px-2">
                            <label for="default-input" class="block mb-2 text-sm font-medium text-white dark:text-white">Monto(Bs.)</label>
                            <input type="text" id="default-input" class="bg-black border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00">
                            {{-- <x-input wire:model.live="valor_dos" placeholder="0.00" disabled/> --}}
                        </div>
                    </div>
    
                    <div class="">
                        <button type="button" wire:click="facturar_servicio()" class="inline-flex w-full justify-center rounded-lg bg-red-600 px-3 py-3 mt-7 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="facturar_servicio" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            <span>Facturar servicio</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
