<!-- resources/views/components/loading.blade.php -->
<div id="loading" {{ $attributes->merge(['class' => 'fixed top-0 left-0 z-50 block w-full h-full bg-black opacity-85']) }}>
    <div class="relative block w-0 h-0 mx-auto my-0 opacity-85 top-1/2">
        <div class="flex-col gap-4 w-full flex items-center justify-center">
            <div class="w-14 h-14 border-4 border-transparent text-[#fd033f] text-4xl animate-spin flex items-center justify-center border-t-[#fd033f] rounded-full">
                <div class="w-10 h-10 border-4 border-transparent text-white text-2xl animate-spin flex items-center justify-center border-t-white rounded-full"></div>
            </div>
            <span class="text-white font-semibold text-sm">Validando</span>
        </div>
    </div>
</div>
