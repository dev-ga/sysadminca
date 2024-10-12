<?php

namespace App\Livewire\Tables;

use App\Models\Sale;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
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
                    ->label('Codigo')
                    ->icon('heroicon-c-tag')
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_sale')
                    ->label('Costo($)')
                    ->money('USD')
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Tipo Pago')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pago-en-tienda'    => 'success',
                        'efectivo-dolares'  => 'success',
                        'pago-movil'        => 'success',
                        'zelle'             => 'success',
                        'banesco-panama'    => 'success',
                    })
                    ->searchable(),
                    
                    Tables\Columns\TextColumn::make('delivery_method')
                    ->label('Metodo Envio')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'retiro-tienda-fisica' => 'danger',
                        'pickup' => 'danger',
                        'delivery' => 'danger',
                    })
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('status.name')
                    ->label('Estatus')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'registrada' => 'warning',
                        'Validando Pago' => 'info',
                        'facturada' => 'success',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('pay_usd')
                    ->label('Pago($)')
                    ->money('USD')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('pay_bsd')
                    ->label('Pago(Bs.)')
                    ->money('VES')
                    ->sortable(),

                Tables\Columns\TextColumn::make('date')
                    ->label('Fecha')
                    ->searchable(),

                Tables\Columns\TextColumn::make('type_sale')
                    ->label('Tipo Venta')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),

                Tables\Columns\TextColumn::make('user_name')
                    ->label('Cliente')
                    ->searchable(),

                ImageColumn::make('qr')->label('QR'),


            ])
            ->filters([
                //
            ])
            ->actions([
                 Tables\Actions\Action::make('Actualizar')
                 ->action(function (Sale $record) {
                    $record->status_id = 2;
                    $record->save(); 
                 })
                 ->requiresConfirmation('¿Estás seguro de actualizar esta orden?'),
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
        return view('livewire.tables.table-list-sale');
    }
}
