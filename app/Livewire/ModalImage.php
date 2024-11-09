<?php

namespace App\Livewire;

use App\Models\Inventory;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalImage extends ModalComponent
{
    public Inventory $inventory;


    public function render()
    {
        $image = $this->inventory->image;

        return view('livewire.modal-image', compact('image'));
    }
}
