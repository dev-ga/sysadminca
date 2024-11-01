<?php

namespace App\Livewire;

use App\Models\ItemCar;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Livewire\Component;

class ViewItemCar extends Component implements HasForms, HasInfolists
{
    use InteractsWithInfolists;
    use InteractsWithForms;
    public ItemCar $itemCar;

    public function mount()
    {
        $this->itemCar = new ItemCar();
    }

    public function itemCarInfolist(Infolist $infolist): Infolist
    {

        return $infolist
            ->record($this->itemCar)
            ->schema([
                TextEntry::make('code'),
                TextEntry::make('inventario_id'),
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.view-item-car');
    }
}
