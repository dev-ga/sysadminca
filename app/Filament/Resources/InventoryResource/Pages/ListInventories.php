<?php

namespace App\Filament\Resources\InventoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\InventoryResource;
use App\Models\Category;
use App\Models\Inventory;
use Filament\Resources\Pages\ListRecords\Tab;

class ListInventories extends ListRecords
{
    protected ?string $heading = 'Inventario de Mercancia';

    protected static string $resource = InventoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    // public function getTabs(): array
    // {
    //     // $categories = Category::all();
    //     // // dd($categories->id);

    //     // foreach($categories as $categoria){
    //     //     $categorias[$categoria->name] = Tab::make()
    //     //     ->query(fn($query) => $query->where('category_id', $categoria->id));
    //     //     // ->badge(Inventory::query()->where('category_id', $categories->id)->count());
    //     // }

    //     // return $categorias;

    //     // return [

    //     //     'Todo' => ListRecords\Tab::make('Todo')->query(fn($query) => $query->orderBy('created_at', 'desc')),
    //     //     'Consumo-interno' => Tab::make()
    //     //         ->query(fn($query) => $query->where('uso', 'consumo-interno'))
    //     //         ->badge(Producto::query()->where('uso', 'consumo-interno')->count()),
    //     //     'Venta' => Tab::make()
    //     //         ->query(fn($query) => $query->where('uso', 'venta'))
    //     //         ->badge(Producto::query()->where('uso', 'venta')->count()),
    //     // ];
    // }
}