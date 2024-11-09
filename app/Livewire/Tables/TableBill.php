<?php

namespace App\Livewire\Tables;

use App\Models\Bill;
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
use Livewire\Attributes\On;

class TableBill extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    #[On('bill-updated')]
    public function updateBill()
    {
        $this->reset();
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Gastos Generales')
            ->description('Tabla de gastos Ciudad Alternativa')
            ->query(Bill::query()->orderBy('id', 'desc'))
            ->columns([
                
                Tables\Columns\TextColumn::make('code')
                    ->color('success')
                    ->icon('heroicon-c-tag')
                    ->label('Código')
                    ->searchable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->searchable(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Método de Pago')
                    ->searchable(),

                Tables\Columns\TextColumn::make('reference')
                    ->label('Referencia')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('created_by')
                    ->color('primary')
                    ->label('Creado por')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->color('primary')
                    ->label('Fecha')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount_usd')
                    ->color('danger')
                    ->icon('heroicon-s-backspace')
                    ->label('Monto USD')
                        ->summarize(Sum::make()
                            ->money('USD')
                            ->label('Total($)'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_bsd')
                    ->color('danger')
                    ->icon('heroicon-s-backspace')
                    ->label('Monto BSD')
                    ->summarize(Sum::make()
                            ->money('VES')
                            ->label('Total($)'))
                    ->sortable(),
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
            ]);
    }

    public function render(): View
    {
        return view('livewire.tables.table-bill');
    }
}
