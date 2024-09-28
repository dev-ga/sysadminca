<?php

namespace App\Livewire;

use App\Models\Inventory;
use App\Models\ItemCar;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use WireUi\Components\Dropdown\Item;
use WireUi\Traits\WireUiActions;

class Search extends Component
{
    use WireUiActions;
    
    #[Validate('required')] 
    public $code;

    public $quantity = [];

    public function errorDialog(): void
    {
        $this->dialog()->show([
            'icon' => 'error',
            'title' => 'Notificacion!',
            'description' => 'El producto no se encuentra en existencia, favor intente con otro',
        ]);

    }

    public function code_no_exit(): void
    {
        $this->notification()->send([
            'icon' => 'info',
            'title' => 'Info Notification!',
            'description' => 'This is a description.',

        ]);

    }

    public function search_item(){

        $this->validate();

        try {

                $search_item = Inventory::where('code', 'like', '%'.$this->code)->first();

                if (!isset($search_item)) {
                    $this->code_no_exit();

                } elseif ($search_item->quantity > 0) {
                    $item_cars = new ItemCar();
                    $item_cars->inventory_id = $search_item->id;
                    $item_cars->code = $search_item->code;
                    $item_cars->user_id = Auth::user()->id;
                    $item_cars->save();

                    $this->reset();
                    
                } else {
                    $this->errorDialog();
                }
            

        } catch (\Throwable $th) {
            dd($th);
        }

    }

    public function add_item($id){
        try {

            foreach ($this->quantity as $key => $value) {
                # code...
                $addItme = ItemCar::where('id', $key)->first()->update([
                    'quantity' => $value,
                    'status' => 2,
                ]);
            }

            $this->dispatch('add-to-card');
            
        } catch (\Throwable $th) {
            dd($th);
        }

    }

    public function render()
    {
        $search = ItemCar::where('user_id', Auth::user()->id)->where('status', 1)->get();
        return view('livewire.search', compact('search'));
    }
}
