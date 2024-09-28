<?php

namespace App\Livewire;

use App\Models\ItemCar;
use App\Models\TasaBcv;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class ShoppingCar extends Component
{
    use WireUiActions;
    
    public function tasa_bcv(){
        $bcv = TasaBcv::where('date', now()->format('d-m-Y'))->first()->tasa;
        return $bcv;
        
    }

    public function count_item(){
        $shopping_car = ItemCar::where('user_id', Auth::id())->where('status', 2)->get();
        return $shopping_car;
        
    }

    public function total_item_card(){
        $total_item_car = ItemCar::where('user_id', Auth::id())->where('status', 2)->count();
        return $total_item_car;
        
    }

    public function total_to_pay(){
        $item = $this->count_item();
        $total = 0;
        foreach ($item as $value){
            $total += $value->inventory->price * $value->quantity;
        }
        return $total;
        
    }

    public function delete($id){
        $this->dialog()->confirm([
            'title' => 'Notificacion!',
            'description' => 'Desea eliminar este item de la lista?',
            'icon' => 'question',
            'accept' => [
                'label' => 'Yes, eliminar',
                'method' => 'delete_item',
                'params' => $id,
            ],

            'reject' => [
                'label' => 'No, cancelar',
                'method' => 'cancel',
            ],

        ]);
    }

    public function delete_item($id) {
        try {

            ItemCar::where('id', $id)->delete();
            $this->dispatch('delete-item-to-card');
            $this->reset();

        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function cancel(){
        $this->reset();
        
    }

    public function pay_sale(){
        return $this->redirect('/costumer/p/s', navigate: true);
        
    }

    public function render()
    {
        $total_pay      = $this->total_to_pay();
        $item_car       = $this->count_item();
        $bcv            = $this->tasa_bcv();
        $total_item_car = $this->total_item_card();
        $total_pay_bsd  = $total_pay * $bcv;
        
        return view('livewire.shopping-car', compact('item_car', 'total_pay', 'total_pay_bsd', 'bcv', 'total_item_car'));
    }
}
