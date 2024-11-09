<?php

namespace App\Livewire\Tables;

use App\Models\PreBilling;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;

class TablePreBilling extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    #[On('add-item')]
    public function updatePreBilling()
    {
        $this->reset();
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Pre-Facturacion')
            ->description('Lista general de inventario')
            ->query(PreBilling::query())
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Código')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Cantidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Precio')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_usd')
                    ->label('Total USD')
                    ->money('USD')
                    ->label('Dolares($)')
                    ->summarize(Sum::make()
                        ->money('USD')
                        ->label('Total a pagar($)'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_bsd')
                    ->label('Total BSD')
                    ->money('VES')
                    ->label('Bolivares(Bs.)')
                    ->summarize(Sum::make()
                        ->money('VES')
                        ->label('Total a pagar(Bs.)'))
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Eliminar')
                ->action(fn (PreBilling $record) => $record->delete())
                ->icon('heroicon-s-trash')
                ->color('danger')
                //
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ])
            ->striped();
    }

    public function render(): View
    {
        return view('livewire.tables.table-pre-billing');
    }
}
