<?php

namespace App\Livewire\Tables;

use App\Models\Sale;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
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
            ->heading('Venta ON-LINE')
            ->description('Tabla de ventas ON-LINE Ciudad Alternativa')
            ->query(Sale::query()->where('type_sale', 'on-line')->orderBy('created_at', 'desc'))
            ->columns([
                Tables\Columns\TextColumn::make('sale_code')
                // ->description(fn (Sale $record): string => $record->total_sale)
                    ->label('Codigo')
                    ->icon('heroicon-c-tag')
                    ->color('success')
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
                        'efectivo-bolivares'=> 'success',
                        'pago-movil'        => 'success',
                        'zelle'             => 'success',
                        'banesco-panama'    => 'success',
                        'transferencia'     => 'success',
                    })
                    ->searchable(),
                    
                    Tables\Columns\TextColumn::make('delivery_method')
                    ->label('Metodo Envio')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'retiro-tienda-fisica'  => 'danger',
                        'pickup'                => 'danger',
                        'delivery'              => 'danger',
                        'envio-nacional'        => 'danger',
                        'N/A'                   => 'info',
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
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),

                Tables\Columns\TextColumn::make('type_sale')
                    ->label('Tipo Venta')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),

                Tables\Columns\TextColumn::make('user_name')
                    ->label('Cliente')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),

                ImageColumn::make('qr')->label('QR'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->searchable(),


            ])
            ->filters([
                //
            ])
            ->actions([
                //  Tables\Actions\Action::make('Actualizar')
                //  ->action(function (Sale $record) {
                //     $record->status_id = 2;
                //     $record->save(); 
                //  })
                //  ->requiresConfirmation('¿Estás seguro de actualizar esta orden?'),
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
        return view('livewire.tables.table-list-sale');
    }
}
