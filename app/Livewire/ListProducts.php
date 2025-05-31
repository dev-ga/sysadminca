<?php

namespace App\Livewire;

use App\Models\ItemCar;
use Livewire\Component;
use App\Models\Inventory;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Notifications\Notification;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;

use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListProducts extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $search = '';

    public function table(Table $table): Table
    {
        return $table
            ->query(Inventory::query()
            ->select('id', 'sku', 'code', 'size', 'color', 'price', 'quantity', 'image',  'category_id', 'subcategory_id')
            ->where('quantity', '>', 0)
            ->where('image', '!=', NULL)
            ->when($this->search, function ($query) {
                $query->where('code', 'like', "%{$this->search}%")
                        ->orWhere('size', 'like', "%{$this->search}%")
                        ->orWhere('color', 'like', "%{$this->search}%")
                        ->orWhere('price', 'like', "%{$this->search}%")
                        ->orWhere('quantity', 'like', "%{$this->search}%");
            }))
            ->columns([
                Stack::make([
                    ImageColumn::make('image')
                        ->alignCenter()
                        ->height('100%')
                        ->width('100%'),
                    Stack::make([
                        TextColumn::make('sku')
                            ->weight(FontWeight::Bold),
                        TextColumn::make('code')
                            ->weight(FontWeight::Bold),
                        TextColumn::make('price')
                            ->badge()
                            ->color('danger')
                            ->money('USD', 2)
                            ->weight(FontWeight::Bold),
                            
                    ]),
                ])->space(3),
            ])
            ->filters([
                //
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->actions([
                Action::make('add_to_cart')
                    ->icon('heroicon-s-shopping-cart')
                    ->color('success')
                    ->button()
                    ->label('Agregar al carrito')
                    ->action(function (Inventory $record) {
                        ItemCar::create([
                            'code' => $record->code,
                            'inventory_id' => $record->id,
                            'user_id' => Auth::user()->id,
                        ]);
                        
                        Notification::make()
                        ->title('ACCION EXITOSA!')
                        ->body('El producto fue anadido con exito a su carrito de compra. Gracias!')
                        ->color('success') 
                        ->icon('heroicon-o-document-text')
                        ->iconColor('success')
                        ->send();

                    })
            ])
            ->bulkActions([
                // ...
            ])
            ->defaultPaginationPageOption(20);
    }

    
    public function render()
    {
        return view('livewire.list-products');
    }
}