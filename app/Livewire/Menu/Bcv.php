<?php

namespace App\Livewire\Menu;

use App\Models\TasaBcv;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Bcv extends Component
{
    #[Validate('required')] 
    public $value;

    public function update_bcv(){
        dd($this->value);
        $this->validate();
        
        try {
            $update_bcv = TasaBcv::updateOrCreate(['id' => 1], [
                'tasa' => $this->value,
                'date' => now()->format('d-m-Y'),
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
        
    }

    public function render()
    {
        return view('livewire.menu.bcv');
    }
}
