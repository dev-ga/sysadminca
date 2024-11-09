<div>
    <div class="flex items-center bg-gray-900">
        <div class="container px-5 mx-auto py-24">
            <div class="flex flex-col items-left justify-start mb-5">
                <h1 class="text-xl font-bold text-white">Cliente: {{ Auth::User()->name }}</h1>
                <p class="text-sm text-gray-300">Total a pagar(Bs.): {{ number_format(($total_pay_bsd), 2, ',', '.') }}</p>
            </div>

            {{-- METODO DE ENTREGA --}}
            <div>
                <div class="flex items-left justify-between mb-1">
                    <h1 class="text-md text-gray-300">Metodo de entrega</h1>
                    <div wire:click='refresh_form' class="flex ml-auto">
                        <svg class="w-6 h-6 text-[#fd033f]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"/>
                          </svg>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2">
                    <div class="w-full">
                        <select wire:model.live='delivery_method' id="bank" class="bg-black border border-white text-white text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5">
                            <option selected>seleccione un metodo</option>
                            <option value="retiro-tienda-fisica">Retiro Tienda Fisica</option>
                            <option value="pickup">Pickup</option>
                            <option value="delivery">Delivery</option>
                            <option value="envio-nacional">Envio Nacional</option>
                        </select>
                        <x-input-error :messages="$errors->get('delivery_method')" class="mt-2" />
                    </div>
                </div>
            </div>

            {{-- METODO DE PAGO --}}
            <div class="{{ ($delivery_method == 'retiro-tienda-fisica' || $delivery_method == 'pickup' || $delivery_method == 'delivery') ? 'display' : 'hidden' }}">
                <div class="flex flex-col items-left justify-start mb-1 mt-5">
                    <h1 class="text-md text-gray-300">Metodo de pago</h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2">
                    <div class="w-full">
                        <select wire:model.live='payment_method' id="bank" class="bg-black border border-white text-white text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5">
                            <option selected>seleccione un metodo</option>
                            <option value="efectivo-dolares">Dolares en Efectivo</option>
                            <option value="zelle">Zelle</option>
                            <option value="pago-movil">Pago Movil</option>
                            <option value="banesco-panama">Banesco Panama</option>
                        </select>
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                </div>
            </div>

            {{-- METODO DE PAGO ENVIO NACIONAL --}}
            <div class="{{ ($delivery_method == 'envio-nacional') ? 'display' : 'hidden' }}">
                {{-- Lista de Estatdos --}}
                <div class="flex flex-col items-left justify-start mb-1 mt-5">
                    <h1 class="text-md text-gray-300">Estado</h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2">
                    <div class="w-full">
                        <select wire:model.live='stateid' id="bank" class="bg-black border border-white text-white text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5">
                            <option selected>seleccione</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>    
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                </div>
                {{-- Lista de Agencias --}}
                <div class="flex flex-col items-left justify-start mb-1 mt-5">
                    <h1 class="text-md text-gray-300">Agencia de Envios</h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2">
                    <div class="w-full">
                        <select wire:model.live='agencyid' id="bank" class="bg-black border border-white text-white text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5">
                            <option selected>seleccione</option>
                            @foreach ($agencies as $agency)
                                <option value="{{ $agency->id }}">{{ $agency->name }}</option>    
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                </div>
                <div class="flex flex-col items-left justify-start mb-1 mt-5">
                    <h1 class="text-md text-gray-300">Sucursal</h1>
                </div>
                {{-- Lista de Sucursales --}}
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2">
                    <div class="w-full">
                        <select wire:model.live='sucursalid' id="bank" class="bg-black border border-white text-white text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5">
                            <option selected>seleccione</option>
                            @foreach ($sucursales as $value)
                                <option value="{{ $value->code }}">{{ $value->name }}</option>    
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                </div>
                <div class="{{ ($sucursalid != '' ) ? 'display' : 'hidden' }}">
                    <div class="flex flex-col items-left justify-start mb-1 mt-5">
                        <h1 class="text-md text-gray-300">Metodo de pago</h1>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2">
                        <div class="w-full">
                            <select wire:model.live='payment_method' id="bank" class="bg-black border border-white text-white text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5">
                                <option selected>seleccione un metodo</option>
                                <option value="efectivo-dolares">Dolares en Efectivo</option>
                                <option value="zelle">Zelle</option>
                                <option value="pago-movil">Pago Movil</option>
                                <option value="banesco-panama">Banesco Panama</option>
                            </select>
                            <x-input-error :messages="$errors->get('code')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- EFECTIVO -->
            <div class="mt-5 {{ ($payment_method == 'efectivo-dolares') ? 'display' : 'hidden' }}">
                <!-- Preview de la imagen -->
                <div class="w-full">
                    <div class="flex items-center justify-center w-full">
                        <!-- Preview de la imagen -->
                        @if ($usd_img)
                        <div class="flex flex-col items-center justify-center mt-5">
                            <div wire:click='delete_usd_img' class="flex ml-auto">
                                <svg class="w-6 h-6 text-[#fd033f]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                            </div>
                            <img class="w-1/2 h-auto" src="{{ $usd_img->temporaryUrl() }}">
                        </div>
                        @endif
                        <!-- Carga de la imagen y spinner -->
                        <div class="flex flex-col items-center justify-center mt-5 {{ ($usd_img != '') ? 'hidden' : '' }}">
                            <div class="p-1">
                                <label class="block mb-2 text-sm font-medium text-gray-300" for="file_input">Cargar imagen de los Dolares</label>
                                    <input wire:model='usd_img' class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="usd_img" type="file">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG(MAX. 1024MB).</p>
                                <x-input-error :messages="$errors->get('usd_img')" class="mt-2" />
                            </div>
                            <div class="p-1">
                                <div wire:loading wire:target="usd_img">
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
                <div class="flex justify-end items-center mt-5">
                    <button wire:click='save_efectivo_dolares' type="button" class=" w-full flex justify-center text-white text-end bg-[#fd033f] hover:bg-black/80 font-extrabold rounded-lg text-sm px-2 py-2.5 items-end mb-2 {{ ($usd_img != '' && $usd_img->temporaryUrl() != null) ? 'display' : 'hidden' }}">
                          <x-loading wire:loading.delay.long wire:target="save_efectivo_dolares" />
                          Cargar Informacion de Pago
                    </button>
                </div>
            </div>

            <!-- PAGO MOVIL -->
            <div class="mt-5 {{ ($payment_method == 'pago-movil') ? 'display' : 'hidden' }}">
                <div class="flex flex-col items-left justify-start mb-1">
                    <h1 class="text-md text-gray-300">Formulario de pago</h1>
                </div>
                <!-- Grid para formulario del pago movil -->
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2">
                    <!-- Referencia -->
                    <div class="w-full">
                        <input type="text" wire:model='pm_ref' class="bg-black border border-white text-white text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5" placeholder="Referencia - ultimos 6" required />
                        <x-input-error :messages="$errors->get('pm_ref')" class="mt-2" />
                    </div>
                    <!-- telefono -->
                    <div class="w-full">
                        <input type="text" wire:model='pm_phone' class="bg-black border border-white text-white text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5" placeholder="Telefono" required />
                        <x-input-error :messages="$errors->get('pm_phone')" class="mt-2" />
                    </div>
                    <!-- banco -->
                    <div class="w-full">
                        <select wire:model='pm_bank' id="bank" class="bg-black border border-white text-white text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5">
                            <option value=" ">Banco</option>
                            @foreach ($bank as $item)
                            <option value={{ $item->code }}>{{ $item->code }} - {{ $item->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('pm_bank')" class="mt-2" />
                    </div>
                    <!-- Preview de la imagen -->
                    <div class="w-full">
                        <div class="flex items-center justify-center w-full">
                            <!-- Preview de la imagen -->
                            @if ($pm_img)
                            <div class="flex flex-col items-center justify-center mt-5">
                                <div wire:click='delete_pm_img' class="flex ml-auto">
                                    <svg class="w-6 h-6 text-[#fd033f]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                </div>
                                <img class="w-1/2 h-auto" src="{{ $pm_img->temporaryUrl() }}">
                            </div>
                            @endif
                            <!-- Carga de la imagen y spinner -->
                            <div class="flex flex-col items-center justify-center mt-5 {{ ($pm_img != '') ? 'hidden' : '' }}">
                                <div class="p-1">
                                    <label class="block mb-2 text-sm font-medium text-gray-300" for="file_input">Cargar Comprobante de pago</label>
                                        <input wire:model='pm_img' class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="pm_img" type="file">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG(MAX. 1024MB).</p>
                                    <x-input-error :messages="$errors->get('pm_img')" class="mt-2" />
                                </div>
                                <div class="p-1">
                                    <div wire:loading wire:target="pm_img">
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
                </div>
                <div class="flex justify-end items-center mt-5">
                    <button wire:click='save_pago_movil' type="button" class=" w-full flex justify-center text-white text-end bg-[#fd033f] hover:bg-black/80 font-extrabold rounded-lg text-sm px-2 py-2.5 items-end me-2 mb-2 {{ ($pm_img != '' && $pm_img->temporaryUrl() != null) ? 'display' : 'hidden' }}">
                          <x-loading wire:loading.delay.long wire:target="save_pago_movil" />
                          Cargar Informacion de Pago
                    </button>
                </div>
            </div>

            <!-- ZELLE -->
            <div class="mt-5 {{ ($payment_method == 'zelle') ? 'display' : 'hidden' }}">
                <div class="flex flex-col items-left justify-start mb-1">
                    <h1 class="text-sm text-gray-300">Formulario de pago para Zelle</h1>
                </div>
                {{-- Grid Zelle --}}
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2">
                    <!-- Nombre del Titular -->
                    <div class="w-full">
                        <input type="text" wire:model='zelle_name' class="bg-black border border-white text-white text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5" placeholder="Nombre del titular" required />
                        <x-input-error :messages="$errors->get('zelle_name')" class="mt-2" />
                    </div>
                    <!-- Correo -->
                    <div class="w-full">
                        <input type="text" wire:model='zelle_email' class="bg-black border border-white text-white text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5" placeholder="correo electronico" required />
                        <x-input-error :messages="$errors->get('zelle_email')" class="mt-2" />
                    </div>
                    <!-- Preview de la imagen Zelle -->
                    <div class="w-full">
                        <div class="flex items-center justify-center w-full">
                            <!-- Preview de la imagen -->
                            @if ($zelle_img)
                            <div class="flex flex-col items-center justify-center mt-5">
                                <div wire:click='delete_zelle_img' class="flex ml-auto">
                                    <svg class="w-6 h-6 text-[#fd033f]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                </div>
                                <img class="w-1/2 h-auto" src="{{ $zelle_img->temporaryUrl() }}">
                            </div>
                            @endif
                            <!-- Carga de la imagen y spinner -->
                            <div class="flex flex-col items-center justify-center mt-5 {{ ($zelle_img != '') ? 'hidden' : '' }}">
                                <div class="p-1">
                                    <label class="block mb-2 text-sm font-medium text-gray-300" for="file_input">Cargar Comprobante de pago</label>
                                        <input wire:model='zelle_img' class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="zelle_img" type="file">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG(MAX. 1024MB).</p>
                                    <x-input-error :messages="$errors->get('zelle_img')" class="mt-2" />
                                </div>
                                <div class="p-1">
                                    <div wire:loading wire:target="zelle_img">
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
                    <div class="flex justify-end items-center mt-5">
                        <button wire:click='save_zelle' type="button" class=" w-full flex justify-center text-white text-end bg-[#fd033f] hover:bg-black/80 font-extrabold rounded-lg text-sm px-2 py-2.5 items-end me-2 mb-2 {{ ($zelle_img != '' && $zelle_img->temporaryUrl() != null) ? 'display' : 'hidden' }}">
                            {{-- <svg class="w-4 h-4 me-2 -ms-1" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="bitcoin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M504 256c0 136.1-111 248-248 248S8 392.1 8 256 119 8 256 8s248 111 248 248zm-141.7-35.33c4.937-32.1-20.19-50.74-54.55-62.57l11.15-44.7-27.21-6.781-10.85 43.52c-7.154-1.783-14.5-3.464-21.8-5.13l10.93-43.81-27.2-6.781-11.15 44.69c-5.922-1.349-11.73-2.682-17.38-4.084l.031-.14-37.53-9.37-7.239 29.06s20.19 4.627 19.76 4.913c11.02 2.751 13.01 10.04 12.68 15.82l-12.7 50.92c.76 .194 1.744 .473 2.829 .907-.907-.225-1.876-.473-2.876-.713l-17.8 71.34c-1.349 3.348-4.767 8.37-12.47 6.464 .271 .395-19.78-4.937-19.78-4.937l-13.51 31.15 35.41 8.827c6.588 1.651 13.05 3.379 19.4 5.006l-11.26 45.21 27.18 6.781 11.15-44.73a1038 1038 0 0 0 21.69 5.627l-11.11 44.52 27.21 6.781 11.26-45.13c46.4 8.781 81.3 5.239 95.99-36.73 11.84-33.79-.589-53.28-25-65.99 17.78-4.098 31.17-15.79 34.75-39.95zm-62.18 87.18c-8.41 33.79-65.31 15.52-83.75 10.94l14.94-59.9c18.45 4.603 77.6 13.72 68.81 48.96zm8.417-87.67c-7.673 30.74-55.03 15.12-70.39 11.29l13.55-54.33c15.36 3.828 64.84 10.97 56.85 43.03z"></path></svg> --}}
                            <svg class="w-6 h-6 me-2 -ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M16.5 15v1.5m0 0V18m0-1.5H15m1.5 0H18M3 9V6a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v3M3 9v6a1 1 0 0 0 1 1h5M3 9h16m0 0v1M6 12h3m12 4.5a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z"/>
                              </svg>
                              Cargar Informacion de Pago
                        </button>
                    </div> 
                </div>
            </div>

            <!-- BANESCO PANAMA -->
            <div class="mt-5 {{ ($payment_method == 'banesco-panama') ? 'display' : 'hidden' }}">
                <div class="flex flex-col items-left justify-start mb-1">
                    <h1 class="text-sm text-gray-300">Formulario de pago para Banesco Panama</h1>
                </div>
                <!-- Grid Formulario -->
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2">
                    <!-- Nombre de Titular -->
                    <div class="w-full">
                        <input type="text" wire:model='bp_name' class="bg-black border border-white text-white text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5" placeholder="Nombre del titular" required />
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                    <!-- Referencia -->
                    <div class="w-full">
                        <input type="text" wire:model='bp_ref' class="bg-black border border-white text-white text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5" placeholder="Referencia" required />
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                    <!-- Preview de la imagen -->
                    <div class="w-full">
                        <div class="flex items-center justify-center w-full">
                            <!-- Preview de la imagen -->
                            @if ($bp_img)
                            <div class="flex flex-col items-center justify-center mt-5">
                                <div wire:click='delete_bp_img' class="flex ml-auto">
                                    <svg class="w-6 h-6 text-[#fd033f]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                </div>
                                <img class="w-1/2 h-auto" src="{{ $bp_img->temporaryUrl() }}">
                            </div>
                            @endif
                            <!-- Carga de la imagen y spinner -->
                            <div class="flex flex-col items-center justify-center mt-5 {{ ($bp_img != '') ? 'hidden' : '' }}">
                                <div class="p-1">
                                    <label class="block mb-2 text-sm font-medium text-gray-300" for="file_input">Cargar Comprobante de pago</label>
                                        <input wire:model='bp_img' class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="zelle_img" type="file">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG(MAX. 1024MB).</p>
                                    <x-input-error :messages="$errors->get('bp_img')" class="mt-2" />
                                </div>
                                <div class="p-1">
                                    <div wire:loading wire:target="bp_img">
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
                    <div class="flex justify-end items-center mt-5">
                        <button wire:click='save_baneco_panama' type="button" class=" w-full flex justify-center text-white text-end bg-[#fd033f] hover:bg-black/80 font-extrabold rounded-lg text-sm px-2 py-2.5 items-end me-2 mb-2 {{ ($bp_img != '' && $bp_img->temporaryUrl() != null) ? 'display' : 'hidden' }}">
                            {{-- <svg class="w-4 h-4 me-2 -ms-1" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="bitcoin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M504 256c0 136.1-111 248-248 248S8 392.1 8 256 119 8 256 8s248 111 248 248zm-141.7-35.33c4.937-32.1-20.19-50.74-54.55-62.57l11.15-44.7-27.21-6.781-10.85 43.52c-7.154-1.783-14.5-3.464-21.8-5.13l10.93-43.81-27.2-6.781-11.15 44.69c-5.922-1.349-11.73-2.682-17.38-4.084l.031-.14-37.53-9.37-7.239 29.06s20.19 4.627 19.76 4.913c11.02 2.751 13.01 10.04 12.68 15.82l-12.7 50.92c.76 .194 1.744 .473 2.829 .907-.907-.225-1.876-.473-2.876-.713l-17.8 71.34c-1.349 3.348-4.767 8.37-12.47 6.464 .271 .395-19.78-4.937-19.78-4.937l-13.51 31.15 35.41 8.827c6.588 1.651 13.05 3.379 19.4 5.006l-11.26 45.21 27.18 6.781 11.15-44.73a1038 1038 0 0 0 21.69 5.627l-11.11 44.52 27.21 6.781 11.26-45.13c46.4 8.781 81.3 5.239 95.99-36.73 11.84-33.79-.589-53.28-25-65.99 17.78-4.098 31.17-15.79 34.75-39.95zm-62.18 87.18c-8.41 33.79-65.31 15.52-83.75 10.94l14.94-59.9c18.45 4.603 77.6 13.72 68.81 48.96zm8.417-87.67c-7.673 30.74-55.03 15.12-70.39 11.29l13.55-54.33c15.36 3.828 64.84 10.97 56.85 43.03z"></path></svg> --}}
                            <svg class="w-6 h-6 me-2 -ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M16.5 15v1.5m0 0V18m0-1.5H15m1.5 0H18M3 9V6a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v3M3 9v6a1 1 0 0 0 1 1h5M3 9h16m0 0v1M6 12h3m12 4.5a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z"/>
                              </svg>
                              Cargar Informacion de Pago
                        </button>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>

