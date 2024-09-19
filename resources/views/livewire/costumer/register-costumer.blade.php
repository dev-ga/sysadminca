<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $phone = '';
    public string $role = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register_costumer(): void
    {
        /**Para eliminar la confirmacion del password */
        $this->password_confirmation = $this->password;

        try {
            $validated = $this->validate([
            'name'      => ['required', 'string', 'max:255'],
            'role'      => ['string', 'max:255'],
            'phone'     => ['required', 'numeric', 'min:3'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'  => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password']  = Hash::make($validated['password']);
        $validated['role']      = 'costumer';

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);

        } catch (\Throwable $th) {
            dd($th);
        }
        
    }
}; ?>

<div>
    {{-- <div class="flex justify-center pt-4">
        <p class="text-white uppercase text-center">Bienvenido al Formulario de Registro</p>
    </div>
    <div class="flex justify-center">
        <p class="text-white text-xs uppercase text-center pb-5">(*) Son campos requeridos</p>   
    </div> --}}
    <form wire:submit="register_costumer">
        <!-- Name -->
        <div>
            <!-- <x-input-label for="name" :value="__('Nombre y Apellido')" /> -->
            <!-- <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" /> -->
            <x-input class="caret-white" icon="user" placeholder="Nombre y Apellido" rounded type="text" name="name"  wire:model="name"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Cedula de identidad -->

        <!-- telefono -->
        <div class="mt-4">
            <x-input class="caret-white" icon="phone" placeholder="Telefono" rounded type="phone" name="phone" wire:model="phone"/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input class="caret-white" icon="at-symbol" placeholder="Email" rounded type="email" name="email" wire:model="email"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input class="caret-white" icon="lock-open" placeholder="contraseña" rounded type="password" name="password" wire:model="password" id="password"/>


            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-6">
            <button class="flex justify-center w-full h-full rounded-3xl border border-[#fd033f] py-3 px-6 mt-1 text-sm items-center sm:text-center font-bold text-white shadow-sm hover:bg-[#fd033f] uppercase">
                <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="register_costumer" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                <span class="text-center items-center shadow-2xl">Registrar</span>
            </button>
        </div>
    </form>
</div>
