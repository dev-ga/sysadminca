<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/costumer/l', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-black rounded-b-2xl">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden relative sm:flex sm:items-center sm:ms-6">
                <button wire:click="logout" id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots"
                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-black rounded-lg hover:border hover:border-[#fd033f] focus:border focus:border-[#fd033f]"
                    type="button">
                    <svg class="w-6 h-6 text-[#fd033f]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                    </svg>
                </button>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button wire:click="logout" id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots"
                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-black rounded-lg hover:border hover:border-[#fd033f] focus:border focus:border-[#fd033f]"
                    type="button">
                    <svg class="w-6 h-6 text-[#fd033f]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

</nav>