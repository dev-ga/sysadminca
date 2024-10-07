<?php

namespace App\Livewire;

use App\Models\Inventory;
use App\Models\ItemCar;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use WireUi\Components\Dropdown\Item;
use WireUi\Traits\WireUiActions;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Search extends Component
{
    use WireUiActions;
    
    #[Validate('required')] 
    public $code;

    public $search;

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
            Notification::make()
            ->title('NOTIFICACION-EXCEPCION')
            ->body($th->getMessage())
            ->color('error') 
            ->icon('heroicon-o-document-text')
            ->iconColor('error')
            ->send();
        }

    }

    //funcion comentada por pruebas
    // public function add_item($id){
    //     try {

    //         foreach ($this->quantity as $key => $value) {
    //             # code...
    //             $addItme = ItemCar::where('id', $key)->first()->update([
    //                 'quantity' => $value,
    //                 'status' => 2,
    //             ]);
    //         }

    //         $this->dispatch('add-to-card');

    //         Notification::make()
    //         ->title('ACCION EXITOSA!')
    //         ->body('El producto fue anadido con exito a su carrito de compra. Gracias!')
    //         ->color('success') 
    //         ->icon('heroicon-o-document-text')
    //         ->iconColor('success')
    //         ->send();
            
    //     } catch (\Throwable $th) {
    //         Notification::make()
    //         ->title('NOTIFICACION-EXCEPCION')
    //         ->body($th->getMessage())
    //         ->color('error') 
    //         ->icon('heroicon-o-document-text')
    //         ->iconColor('error')
    //         ->send();
    //     }

    // }

    public function add_item($id){

        try {

            $search_item = Inventory::where('id', $id)->first();

            if ($search_item->quantity > 0) {
                    $item_cars = new ItemCar();
                    $item_cars->inventory_id = $search_item->id;
                    $item_cars->code = $search_item->code;
                    $item_cars->user_id = Auth::user()->id;
                    $item_cars->status =2;
                    foreach ($this->quantity as $key => $value) {
                        if($key == $id){
                            $item_cars->quantity = $value;
                        }
                    $item_cars->save();   
                }

                $this->reset();

                $this->dispatch('add-to-card');

                Notification::make()
                ->title('ACCION EXITOSA!')
                ->body('El producto fue anadido con exito a su carrito de compra. Gracias!')
                ->color('success') 
                ->icon('heroicon-o-document-text')
                ->iconColor('success')
                ->send();
   
            } else {
                $this->errorDialog();
            }
    
        } catch (\Throwable $th) {
            Notification::make()
            ->title('NOTIFICACION-EXCEPCION')
            ->body($th->getMessage())
            ->color('error') 
            ->icon('heroicon-o-document-text')
            ->iconColor('error')
            ->send();
        }

    }

    public function render()
    {
        $search = ItemCar::where('user_id', Auth::user()->id)->where('status', 1)->get();
        
        $books = Inventory::query()
        ->select('id', 'sku', 'code', 'size', 'color', 'price', 'quantity')
        ->orderBy('id', 'desc')
        ->when(
            $this->search,
            fn (Builder $query) => $query
                ->where('sku', 'like', "%{$this->search}%")
                ->orWhere('code', 'like', "%{$this->search}%")
        )->paginate(30);

        

        return view('livewire.search', [
            'books' => $books
        ]);
    }
}
