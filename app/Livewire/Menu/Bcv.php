<?php

namespace App\Livewire\Menu;

use App\Livewire\MenuEmployee;
use App\Models\TasaBcv;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Bcv extends Component
{
    #[Validate('required')] 
    public $value;

    public function update_bcv(){

        $this->validate();
        
        try {
            
            TasaBcv::updateOrCreate(['id' => 1], [
                'tasa' => $this->value,
                'date' => now()->format('d-m-Y'),
            ]);

            $this->reset();

            $this->dispatch('valueBcvModified');

            $this->redirectRoute('box');

        } catch (\Throwable $th) {
            dd($th);
        }
        
    }

    public function render()
    {
        return view('livewire.menu.bcv');
    }
}
