<?php

namespace App\Livewire\Tables;

use App\Models\DailyClosing;
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

class TableDailyClosing extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    #[On('daily-closing-updated')]
    public function updateDailyClosing()
    {
        $this->reset();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(DailyClosing::query())
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Codigo')
                    ->color('success')
                    ->icon('heroicon-c-tag')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ref_debito')
                    ->label('Ref. Debito')
                    ->description(fn (DailyClosing $record): string => $record->ref_debito)
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('ref_credito')
                    ->label('Ref. Credito')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('ref_visaMaster')
                    ->label('Ref. Visa/Master')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount_debito')
                    ->color('info')
                    ->description(fn (DailyClosing $record): string => '#Lote: '.$record->ref_debito)
                    ->icon('heroicon-s-building-library')
                    ->label('Monto Debito')
                    ->money('VES')
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_credito')
                    ->color('info')
                    ->description(fn (DailyClosing $record): string => '#Lote: '.$record->ref_credito)
                    ->icon('heroicon-s-building-library')
                    ->label('Monto Credito')
                    ->money('VES')
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_visaMaster')
                    ->color('info')
                    ->description(fn (DailyClosing $record): string => '#Lote: '.$record->ref_visaMaster)
                    ->icon('heroicon-s-building-library')
                    ->label('Monto Visa/Master')
                    ->money('VES')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_pago_movil')
                    ->color('info')
                    ->icon('heroicon-s-building-library')
                    ->label('Pago Movil')
                    ->money('VES')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_zelle')
                    ->color('success')
                    ->icon('heroicon-s-currency-dollar')
                    ->label('Zelle')
                    ->money('USD')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_banesco_panama')
                    ->color('success')
                    ->icon('heroicon-s-currency-dollar')
                    ->label('Banesco Panama')
                    ->money('USD')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_efectivo_usd')
                    ->color('success')
                    ->icon('heroicon-s-currency-dollar')
                    ->label('Efectivo USD')
                    ->money('USD')
                    ->summarize(Sum::make()
                        ->money('USD')
                        ->label('Total en Caja($)'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_by')
                    ->color('primary')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
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
        return view('livewire.tables.table-daily-closing');
    }
}
