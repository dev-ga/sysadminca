<div>
    <div class="flex justify-center items-center w-full max-w-sm mt-5 p-5 bg-black border border-[#fd033f] rounded-lg shadow-[0_3px_10px_rgb(0,0,0,0.2)]">
        <div>
            <div class="flex flex-col items-center pb-10">
                <img class="mt-5 w-full h-auto" src="{{ asset('image/logo_bcv.png') }}" alt="">
                
                <div class="max-w-sm mx-auto">
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M3 21h18M4 18h16M6 10v8m4-8v8m4-8v8m4-8v8M4 9.5v-.955a1 1 0 0 1 .458-.84l7-4.52a1 1 0 0 1 1.084 0l7 4.52a1 1 0 0 1 .458.84V9.5a.5.5 0 0 1-.5.5h-15a.5.5 0 0 1-.5-.5Z"/>
                              </svg>
                              
                        </div>
                        <input wire:model='value' type="text" id="phone-input" aria-describedby="helper-text-explanation" class="bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5  pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="34.78" required />
                    </div>
                    <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Ejemplo: 35.78</p>
                </div>
    
                <div class="flex mt-4 md:mt-6">
                    <a href="#" wire:click='update_bcv' class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-[#fd033f] rounded-lg hover:bg-black hover:border hover:border-[#fd033f] focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</a>
                </div>
            </div>
        </div>
    </div>

</div>

