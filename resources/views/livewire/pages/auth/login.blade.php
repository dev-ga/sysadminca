<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: false);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex items-center justify-center mb-3">
        <h1 class="text-white text-md font-extrabold uppercase">Bienvenidos</h1>
    </div>

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-input class="caret-white" icon="user" placeholder="Email" rounded type="email" name="email" wire:model="form.email"/>
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input icon="user" placeholder="Contraseña" rounded type="password" name="password" wire:model="form.password" autocomplete="current-password"/>
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-6">
            <button class="flex justify-center w-full h-full rounded-3xl border border-[#fd033f] py-3 px-6 mt-1 text-sm items-center sm:text-center font-bold text-white shadow-sm hover:bg-[#fd033f] uppercase">
                <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="register_costumer" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin h-5 w-5 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                <span class="text-center items-center shadow-2xl">Entrar</span>
            </button>
        </div>
        <div class="flex justify-center items-center mt-2 text-white">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="ml-1 text-sm text-[#fd033f] transition-colors duration-200 underline">
            {{ __('Registrate') }}
            </a>
        </div>
    </form>
</div>
