<?php

namespace App\Livewire\Tables;

use App\Models\Sale;
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

class TableDailySale extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function refreshData(){
        $this->reset();
    }

    public function table(Table $table): Table
    {
        $fecha = now()->format('d-m-Y:h:m:s');
        return $table
            ->heading('Venta Diaria')
            ->description('Venta Ciudad Alternativa al '.$fecha)
            ->query(Sale::query()->whereBetween('created_at', [date('Y-m-d').':00:00:00.000', date('Y-m-d').':23:59:59.000'])->orderBy('created_at', 'desc'))
            ->columns([
                Tables\Columns\TextColumn::make('sale_code')
                    ->label('Codigo')
                    ->color('success')
                    ->icon('heroicon-c-tag')
                    ->searchable(),

                // Tables\Columns\TextColumn::make('user_name')
                //     ->label('Cliente')
                //     ->searchable()
                //     ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Forma de Pago')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pago-en-tienda'        => 'success',
                        'efectivo-dolares'      => 'success',
                        'pago-movil'            => 'success',
                        'zelle'                 => 'success',
                        'banesco-panama'        => 'success',
                        'transferencias'        => 'success',
                        'efectivo-bolivares'    => 'success',
                        'multi-moneda'          => 'success',
                    })
                    ->searchable(),

                // Tables\Columns\TextColumn::make('multiMoneda_method_usd')
                //     ->label('Metodo USD')
                //     ->badge()
                //     ->color(fn (string $state): string => match ($state) {
                //         'efectivo-dolares'      => 'success',
                //         'zelle'                 => 'success',
                //         'banesco-panama'        => 'success',
                //         'N/A'                   => 'info',
                //     })
                //     ->searchable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('multiMoneda_method_bsd')
                //     ->label('Metodo BSD')
                //     ->badge()
                //     ->color(fn (string $state): string => match ($state) {
                //         'pago-movil'            => 'success',
                //         'transferencias'        => 'success',
                //         'efectivo-bolivares'    => 'success',
                //         'N/A'                   => 'info',
                //     })
                //     ->searchable()
                //     ->toggleable(isToggledHiddenByDefault: true),

                // Tables\Columns\TextColumn::make('delivery_method')
                //     ->label('Tipo Envio')
                //     ->badge()
                //     ->color(fn (string $state): string => match ($state) {
                //         'retiro-tienda-fisica'  => 'danger',
                //         'pickup'                => 'danger',
                //         'delivery'              => 'danger',
                //         'envio-nacional'        => 'danger',
                //         'N/A'                   => 'info',
                //     })
                //     ->searchable(),

                Tables\Columns\TextColumn::make('type_sale')
                    ->label('Tipo Venta')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'on-line' => 'info',
                        'tienda-fisica' => 'success',
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

                Tables\Columns\TextColumn::make('tasa_bcv')
                    ->money('VES')
                    ->label('TasaBCV')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('total_sale')
                    ->money('USD')
                    ->label('Venta')
                    ->summarize(Sum::make()
                        ->money('USD')
                        ->label('Total($)'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('pay_usd')
                    ->alignCenter()
                    ->money('USD')
                    ->label('Pago($)')
                    ->summarize(Sum::make()
                        ->money('USD')
                        ->label('Total($)'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('pay_bsd')
                    ->alignCenter()
                    ->money('VES')
                    ->label('Pago(Bs.)')
                    ->summarize(Sum::make()
                        ->money('VES')
                        ->label('Total(Bs.)'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('date')
                    ->label('Fecha Venta')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),


                Tables\Columns\TextColumn::make('created_by')
                    ->label('Responsable')
                    ->searchable()
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
            ])
            ->striped()
            ->defaultPaginationPageOption(5);
    }

    public function render(): View
    {
        return view('livewire.tables.table-daily-sale');
    }
}
