<?php

namespace App\Livewire\Tables;

use App\Models\SaleDetail;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class TableSaleDetail extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Detalle de venta ON-LINE')
            ->description('Tabla de detalle para ventas ON-LINE')
            ->query(SaleDetail::query()->orderBy('created_at',  'desc'))
            ->columns([

                Tables\Columns\TextColumn::make('sale_code')
                    ->label('Codigo')
                    ->color('success')
                    ->icon('heroicon-c-tag')
                    ->searchable(),

                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),

                Tables\Columns\TextColumn::make('inventory_code')
                    ->label('Nro.Inventario')
                    ->searchable(),

                Tables\Columns\TextColumn::make('size')
                    ->label('Talla')
                    ->searchable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Precio')
                    ->color('success')
                    ->icon('heroicon-s-currency-dollar')
                    ->money('USD')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Cantidad')
                    // ->alignCenter()
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_pay_usd')
                    ->label('Venta($)')
                    ->money('USD')
                    ->summarize(Sum::make()
                        ->money('USD')
                        ->label('Total($)'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_by')
                    ->toggleable(isToggledHiddenByDefault: true)
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
            ->striped();
    }

    public function render(): View
    {
        return view('livewire.tables.table-sale-detail');
    }
}
