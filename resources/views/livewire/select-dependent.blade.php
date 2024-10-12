<div>
    <div class="w-full">
        <label class="text-sm" for="">Categorias</label>
        <select wire:model.live='categoryId' id="countries" class="bg-black border border-white text-gray-400 text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5">
            <option selected>...</option>
            @foreach ($categories as $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
          </select>
        {{-- <input type="text" wire:model.live='search_category' class="bg-black border border-white text-white text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5" placeholder="CA-32569076" /> --}}
        <x-input-error :messages="$errors->get('code')" class="mt-2" />
    </div>
    <div class="w-full">
        <label class="text-sm" for="">Subcategorias</label>
        <select wire:model.live='search_category' id="countries" class="bg-black border border-white text-gray-400 text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5">
            <option selected>...</option>
            @foreach ($categories as $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
          </select>
        {{-- <input type="text" wire:model.live='search_category' class="bg-black border border-white text-white text-sm rounded-lg focus:ring-[#fd033f] focus:border-[#fd033f] block w-full ps-10 p-2.5" placeholder="CA-32569076" /> --}}
        <x-input-error :messages="$errors->get('code')" class="mt-2" />
    </div>
</div>
