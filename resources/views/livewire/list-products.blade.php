
<div class="dark boder">
        <!-- Campo de búsqueda -->
        <div class="flex">
            <input wire:model.live="search" type="text" placeholder="Buscar..." class="mb-2 w-full rounded-xl border-[#fc023e] shadow-sm focus:border-[#fc023e] text-white bg-[#1d2332]" />

        </div>

        {{ $this->table }}
</div>
