<?php

namespace App\Livewire;

use App\Models\TasaBcv;
use Livewire\Attributes\Validate;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalBcv extends ModalComponent
{
    #[Validate('required')] 
    public $value;

    public function update_bcv(){
        $this->validate();
        
        try {
            
            $update_bcv = TasaBcv::updateOrCreate(['id' => 1], [
                'tasa' => $this->value,
                'date' => now()->format('d-m-Y'),
            ]);

            $this->closeModalWithEvents([
                MenuEmployee::class => 'valueBcvModified',
            ]);

        } catch (\Throwable $th) {
            dd($th);
        }
        
    }
    
    public function render()
    {
        return view('livewire.modal-bcv');
    }
}
