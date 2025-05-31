<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\ItemCar;
use App\Models\SubCategory;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use WireUi\Components\Dropdown\Item;
use WireUi\Traits\WireUiActions;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class Search extends Component
{
    use WireUiActions;
    use WithPagination;
    
    #[Validate('required')] 
    public $code;

    public $search;
    public $search_category;

    public $quantity = [];

    public $categories = [];
    public $subCategories = [];
    public $tallas = [];
    public $color = [];

    public $categoryId;
    public $subCategoryId;
    public $tallaId;
    public $colorId;


    public function mount(){
        $this->categories = Category::where('status', 'activa')->get();
        $this->subCategories = collect();
        $this->tallas = collect();
    }

    public function updatedCategoryId($value){
        $this->subCategories = SubCategory::where('category_id', $value)->get();
    }

    public function updatedSubCategoryId($value){
        $this->tallas = DB::table('inventories')
        ->where('category_id', '=', $this->categoryId)
        ->where('subcategory_id', '=', $this->subCategoryId)
        ->groupBy('size')
        ->get('size');
    }

    public function updatedTallaId($value){
        $this->color = DB::table('inventories')
        ->where('category_id', '=', $this->categoryId)
        ->where('subcategory_id', '=', $this->subCategoryId)
        ->where('size', '=', $this->tallaId)
        ->groupBy('color')
        ->get('color');
    }

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
                    $item_cars->image =  $search_item->image;
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

                $this->redirectRoute('search-item', navigate: true);
   
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
        ->select('id', 'sku', 'code', 'size', 'color', 'price', 'quantity', 'image',  'category_id', 'subcategory_id')
        ->where('quantity', '>', 0)
        ->where('image', '!=', NULL)
        ->orderBy('id', 'desc')
        ->when(
            $this->categoryId,
            fn (Builder $query) => $query
                ->where('category_id', '=', $this->categoryId)

        )
        ->when(
            $this->subCategoryId,
            fn (Builder $query) => $query
                ->Where('subcategory_id', '=', $this->subCategoryId)

        )
        ->when(
            $this->tallaId,
            fn (Builder $query) => $query
                ->Where('size', '=', $this->tallaId)

        )
        ->when(
            $this->colorId,
            fn (Builder $query) => $query
                ->Where('color', '=', $this->colorId)

        )->paginate(30);

        $count = count($books);

        return view('livewire.search', [
            'books' => $books,
            'count' => $count,
        ]);
    }
}