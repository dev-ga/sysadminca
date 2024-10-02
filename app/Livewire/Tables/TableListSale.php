<?php

namespace App\Livewire\Tables;

use App\Models\Sale;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class TableListSale extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Sale::query())
            ->columns([
                Tables\Columns\TextColumn::make('sale_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_sale')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Forma de Pago')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pago-en-tienda' => 'success',
                        'efectivo-dolares' => 'success',
                        'pago-movil' => 'success',
                        'zelle' => 'success',
                        'banesco-panama' => 'success',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('delivery_method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tasa_bcv')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pay_bsd')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pay_usd')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type_sale')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('commission_bsd')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('commission_usd')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('proofPayment.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qr')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
        return view('livewire.tables.table-list-sale');
    }
}
