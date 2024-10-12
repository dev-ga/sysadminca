<?php

namespace App\Livewire\Tables;

use App\Models\Inventory;
use App\Models\PreBilling;
use App\Models\TasaBcv;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class TableInventory extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Calzados, Lenceria y Accesorios')
            ->description('Lista general de inventario')
            ->query(Inventory::query()->where('quantity', '>', 0))
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('size')
                    ->searchable(),
                Tables\Columns\TextColumn::make('color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                TextInputColumn::make('pre_quantity'),
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
                ->requiresConfirmation(),
           ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ])
            ->defaultPaginationPageOption(5);
    }

    public function render(): View
    {
        return view('livewire.tables.table-inventory');
    }
}
