<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\Sale;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use App\Filament\Resources\SaleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SaleResource\RelationManagers;
use App\Filament\Resources\SaleResource\RelationManagers\SaleDetailsRelationManager;
use App\Filament\Resources\SaleResource\RelationManagers\DsaleDetailsRelationManager;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-c-presentation-chart-bar';

    protected static ?string $navigationGroup = 'Ventas';

    protected static ?string $navigationLabel = 'Dashboard de Venta';

    public static function table(Table $table): Table
    {
        return $table
            ->query(Sale::query()->orderBy('created_at', 'desc'))    
            ->columns([
                Tables\Columns\TextColumn::make('sale_code')
                    ->label('Codigo')
                    ->searchable(),

                Tables\Columns\TextColumn::make('user_name')
                    ->label('Cliente')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                    Tables\Columns\TextColumn::make('employee.name')
                    ->label('Acesor')
                    ->searchable(),

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
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                    Tables\Columns\TextColumn::make('multiMoneda_method_usd')
                    ->label('Metodo USD')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'efectivo-dolares'      => 'success',
                        'zelle'                 => 'success',
                        'banesco-panama'        => 'success',
                        'N/A'                   => 'info',
                    })
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    Tables\Columns\TextColumn::make('multiMoneda_method_bsd')
                    ->label('Metodo BSD')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pago-movil'            => 'success',
                        'transferencias'        => 'success',
                        'efectivo-bolivares'    => 'success',
                        'N/A'                   => 'info',
                    })
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('delivery_method')
                    ->label('Tipo Envio')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'retiro-tienda-fisica'  => 'danger',
                        'pickup'                => 'danger',
                        'delivery'              => 'danger',
                        'envio-nacional'        => 'danger',
                        'N/A'                   => 'info',
                    })
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('type_sale')
                    ->label('Tipo Venta')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'on-line' => 'info',
                        'tienda-fisica' => 'success',
                    })
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('status')
                    ->label('Estatus')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'MANUAL' => 'success',
                        'FISCAL' => 'warning',
                    })
                    ->searchable(),

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

                Tables\Columns\TextColumn::make('commission_usd')
                    ->alignCenter()
                    ->label('Comision($)')
                    ->money('USD')
                    ->summarize(Sum::make()
                        ->money('USD')
                        ->label('Total'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('commission_bsd')
                    ->alignCenter()
                    ->label('Comision(Bs.)')
                    ->money('VES')
                    ->summarize(Sum::make()
                        ->money('VES')
                        ->label('Total'))
                    ->sortable(),



                Tables\Columns\TextColumn::make('created_by')
                    ->label('Responsable')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->groups([
                'type_sale',
                'date',
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('desde'),
                        DatePicker::make('hasta'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['desde'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['hasta'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['desde'] ?? null) {
                            $indicators['desde'] = 'Venta desde ' . Carbon::parse($data['desde'])->toFormattedDateString();
                        }
                        if ($data['hasta'] ?? null) {
                            $indicators['hasta'] = 'Venta hasta ' . Carbon::parse($data['hasta'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
                    SelectFilter::make('status')
                    ->label('Estatus')
                    ->options([
                        'MANUAL' => 'MANUAL',
                        'FISCAL' => 'FISCAL',
                    ])
            ])
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filtros'),
            )
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('fiscalizar')
                        ->label('Fiscalizar')
                        ->icon('heroicon-s-server')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion()
                        ->action(function (Collection $records) {
                            foreach ($records as $record) {
                                $record->saleDetails()->update(['status' => 'FICALIZADA']);
                                $record->status = 'FICALIZADA';
                                $record->save();
                            }
                        }),
                ]),
            ])
            ->striped();
    }

    public static function getRelations(): array
    {
        return [
            SaleDetailsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }
}