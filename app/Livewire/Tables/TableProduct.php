<?php

namespace App\Livewire\Tables;

use App\Models\Inventory;
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
use Livewire\Attributes\On;

class TableProduct extends Component implements HasForms, HasTable
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
        $fecha = now()->format('d-m-Y:h:m:s');

        return $table
            ->heading('Inventario Ciudad Alternativa')
            ->description('Tabla general de inventario hasta el: '.$fecha)
            ->query(Inventory::query()->orderBy('created_at', 'desc'))
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->color('success')
                    ->icon('heroicon-c-tag')
                    ->searchable(),

                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->icon('heroicon-s-view-columns')
                    ->color('info')
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->color('success')
                    ->icon('heroicon-m-list-bullet')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('size')
                    ->searchable(),

                Tables\Columns\TextColumn::make('color')
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->color('success')
                    ->icon('heroicon-s-currency-dollar')
                    ->money('USD')
                    ->sortable(),

                TextInputColumn::make('quantity')
                    ->label('Cantidad'),

                Tables\Columns\TextColumn::make('created_by')
                    ->icon('heroicon-m-user')
                    ->color('primary')
                    ->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ])
            ->striped()
            ->defaultPaginationPageOption(5);
    }

    public function render(): View
    {
        return view('livewire.tables.table-product');
    }
}
