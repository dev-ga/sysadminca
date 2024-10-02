<div class="z-index w-full max-w-2xl max-h-full p-4 bg-gray-800 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex justity-center items-center">
        <img class="w-20 h-auto" src="{{ asset('image/logo_bcv_2.png') }}" alt="">
        <h5 class="ml-5 text-base text-white font-semibold md:text-xl dark:text-white">
        Tasa B.C.V
        </h5>
    </div>
    <p class="text-sm mb-2 mt-4 font-normal text-white">Costo del Dolar en Bolivares</p>
                <div>
                    <x-currency 
                        prefix="Bs"
                        decimal="."
                        precision="4"
                        wire:model="value"
                    />
                </div>
    <div class="sm:mt-2">
        <button type="button" wire:click='update_bcv()'  class="inline-flex w-full justify-center rounded-lg bg-green-600 px-3 py-3 mt-10 text-sm font-semibold text-white shadow-sm hover:bg-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="update_bcv" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
            <span>Actualizar</span>
        </button>
    </div>
</div>
