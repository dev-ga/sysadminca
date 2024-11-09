<?php

namespace App\Livewire\Menu;

use App\Models\Category;
use App\Models\Inventory as ModelsInventory;
use App\Models\SubCategory;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;

class Inventory extends Component
{
    use WireUiActions;
    use WithPagination;
    use WithFileUploads;

    public $image;
    public $res;
    
    #[Validate('required')]
    public $sku;
    
    #[Validate('required')]
    public $color;
    
    public $material;
    
    public $size;
    
    public $array_size;

    public $quantity;

    #[Validate('required')]
    #[Validate('numeric', message: 'Requiere solo numeros')]
    public $price;

    public $code;

    public $categories = [];
    public $subCategories = [];

    #[Validate('required', as: 'categoria')]
    public $categoryId;

    #[Validate('required', as: 'sub-categoria')]
    public $subCategoryId;

    public function mount(){
        $this->categories = Category::where('status', 'activa')->get();
        $this->subCategories = collect();
    }

    public function updatedCategoryId($value){
        $this->subCategories = SubCategory::where('category_id', $value)->get();
    }

    public function delete_image()
    {
        $this->reset('image');
    }

    public function upload_inventory(){
        $this->validate();

        try {

            //code...
            if($this->res == true){

                $array_tallas_completas = ['35', '36', '37', '38', '39', '40'];
                $array_quantity_tc      = ['1', '3', '3', '3', '1', '1'];
    
                $array_tallas_medias    = ['5.5', '6', '6.5', '7', '7.5', '8', '8.5', '9', '10'];
                $array_quantity_tm      = ['1', '1', '1', '2', '2', '2', '1', '1', '1'];
    
                if($this->array_size == 'completa'){
                    for ($i=0; $i < count($array_tallas_completas) ; $i++) { 
                        $inventario = new ModelsInventory();
                        $inventario->sku = $this->sku;
                        $inventario->product = $this->sku;
                        $inventario->code = 'CA-'.random_int(11111111, 99999999);
                        $inventario->category_id = $this->categoryId;
                        $inventario->subcategory_id = $this->subCategoryId;
                        $inventario->size = $array_tallas_completas[$i];
                        $inventario->quantity = $array_quantity_tc[$i];
                        $inventario->color = $this->color;
                        $inventario->price = $this->price;
                        $inventario->created_by = Auth::user()->name;
                        $inventario->save();
                    }
                }
    
                if($this->array_size == 'medias'){

                    for ($i=0; $i < count($array_tallas_medias) ; $i++) { 
                        $inventario = new ModelsInventory();
                        $inventario->sku = $this->sku;
                        $inventario->product = $this->sku;
                        $inventario->code = 'CA-'.random_int(11111111, 99999999);
                        $inventario->category_id = $this->categoryId;
                        $inventario->subcategory_id = $this->subCategoryId;
                        $inventario->size = $array_tallas_medias[$i];
                        $inventario->quantity = $array_quantity_tm[$i];
                        $inventario->color = $this->color;
                        $inventario->price = $this->price;
                        $inventario->created_by = Auth::user()->name;
                        $inventario->save();    # code...
                    }
                }
    
            }else{

                $inventario = new ModelsInventory();
                $inventario->sku = $this->sku;
                $inventario->product = $this->sku;
                $inventario->code = 'CA-'.random_int(11111111, 99999999);
                $inventario->category_id = $this->categoryId;
                $inventario->subcategory_id = $this->subCategoryId;
                $inventario->size = $this->size;
                $inventario->color = $this->color;
                $inventario->quantity = $this->quantity;
                $inventario->price = $this->price;
                $inventario->created_by = Auth::user()->name;
                $inventario->save();
    
            }

            $this->dispatch('inventory-updated');
            
            Notification::make()
                ->title('CARGA EXITOSA!')
                ->body('El producto fue cargado con Exito. Gracias!')
                ->color('success') 
                ->icon('heroicon-o-document-text')
                ->iconColor('success')
                ->send();

            $this->reset();

        } catch (\Throwable $th) {
            Notification::make()
            ->title('NOTIFICACIÓN')
            ->icon('heroicon-o-document-text')
            ->iconColor('danger')
            ->color('danger')
            ->body($th->getMessage())
            ->send();
        }

        
    }

    public function render()
    {
        $this->code = 'CA-' . random_int(11111111, 99999999);
        return view('livewire.menu.inventory');
    }
}
