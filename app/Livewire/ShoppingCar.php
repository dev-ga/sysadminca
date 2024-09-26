<?php

namespace App\Livewire;

use App\Models\ItemCar;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShoppingCar extends Component
{
    public function count_item(){
        $shopping_car = ItemCar::where('user_id', Auth::id())->where('status', 2)->get();
        return $shopping_car;
        
    }

    public function total_to_pay()
    {
        $item = $this->count_item();
        $total = 0;
        foreach ($item as $value){
            $total += $value->inventory->price * $value->quantity;
        }
        return $total;
        
    }
    public function render()
    {
        $total_pay  = $this->total_to_pay();
        $item_car   = $this->count_item();
        
        return view('livewire.shopping-car', compact('item_car', 'total_pay'));
    }
}
