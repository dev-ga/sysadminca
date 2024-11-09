<x-costumer-auth-app>

    <div class="py-12 px-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-14">
            <div class="p-4 sm:p-8 bg-black shadow rounded-xl">
                <div class="max-w-xl text-black">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-black shadow rounded-xl">
                <div class="max-w-xl text-black">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-black shadow rounded-xl">
                <div class="max-w-xl text-black">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>

    <div class="h-20"></div>

    @livewire('botto-menu-costumer')

</x-costumer-auth-app>