<?php

namespace App\Livewire\Tables;

use App\Models\Inventory;
use App\Models\PreBilling;
use App\Models\TasaBcv;
use Filament\Forms\Components\Builder as ComponentsBuilder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;

class TableInventory extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    #[On('inventory-updated')]
    public function updateInventory()
    {
        $this->reset();
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Calzados, Lenceria y Accesorios')
            ->description('Lista general de inventario')
            ->query(Inventory::query()->where('quantity', '>', 0)->orderBy('created_at', 'desc'))
            ->columns([
                TextColumn::make('code')
                    ->label('Codigo')
                    ->color('success')
                    ->icon('heroicon-c-tag')
                    ->searchable(isIndividual: true),
                TextColumn::make('product')
                    ->label('Articulo')
                    ->searchable(isIndividual: true),

                TextColumn::make('category.name')
                    ->label('Categoria')
                    ->numeric()
                    ->searchable(isIndividual: true),
            TextColumn::make('price')
                    ->label('Precio')
                    ->color('success')
                    ->icon('heroicon-s-currency-dollar')
                    ->money()
                    ->searchable(isIndividual: true),

            TextColumn::make('quantity')
                    ->label('Exitencia')
                    ->icon('heroicon-m-adjustments-horizontal'),

                TextInputColumn::make('pre_quantity')
                ->label('Cantidad'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Añadir')
                ->action(function (Inventory $record) {

                    $tasa_bcv = TasaBcv::where('date', now()->format('d-m-Y'))->first()->tasa;

                    $pre_billing = new PreBilling();
                    $pre_billing->inventory_id = $record->id;
                    $pre_billing->code = $record->code;
                    $pre_billing->price = $record->price;
                    $pre_billing->quantity = $record->pre_quantity;
                    $pre_billing->total_usd = $record->price * $record->pre_quantity;
                    $pre_billing->total_bsd = $record->pre_quantity * ($record->price * $tasa_bcv);
                    $pre_billing->save();

                    $this->dispatch('add-item');

                    $record->pre_quantity = 0;
                    $record->save();



                })
                ->icon('heroicon-m-hand-thumb-up')
                ->color('success')
                // ->requiresConfirmation(),
           ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ])
            ->striped();
    }

    public function render(): View
    {
        return view('livewire.tables.table-inventory');
    }
}