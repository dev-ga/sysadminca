<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleResource\Pages;
use App\Filament\Resources\SaleResource\RelationManagers;
use App\Models\Sale;
use Carbon\Carbon;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-s-adjustments-horizontal';

    protected static ?string $navigationGroup = 'Ventas';

    protected static ?string $navigationLabel = 'Dashboard de Venta';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sale_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('total_sale')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('payment_method')
                    ->maxLength(255),
                Forms\Components\TextInput::make('tasa_bcv')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('pay_bsd')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('pay_usd')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('date')
                    ->maxLength(255),
                Forms\Components\TextInput::make('type_sale')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('user_id')
                    ->numeric(),
                Forms\Components\TextInput::make('user_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('commission_bsd')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('commission_usd')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('created_by')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('delivery_method')
                    ->maxLength(100),
                Forms\Components\FileUpload::make('image')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sale_code')
                    ->label('Codigo')
                    ->searchable(),

                Tables\Columns\TextColumn::make('user_name')
                    ->label('Cliente')
                    ->searchable(),

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
                    ->label('Tipo Envio')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'retiro-tienda-fisica' => 'danger',
                        'pickup' => 'danger',
                        'delivery' => 'danger',
                    })
                    ->searchable(),

                Tables\Columns\TextColumn::make('type_sale')
                    ->label('Tipo Venta')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'on-line' => 'info',
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

                Tables\Columns\TextColumn::make('pay_bsd')
                    ->alignCenter()
                    ->money('VES')
                    ->label('Pago(Bs.)')
                    ->summarize(Sum::make()
                        ->money('VES')
                        ->label('Total(Bs.)'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('pay_usd')
                    ->alignCenter()
                    ->money('USD')
                    ->label('Pago($)')
                    ->summarize(Sum::make()
                        ->money('USD')
                        ->label('Total($)'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('date')
                    ->label('Fecha Venta')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),


                Tables\Columns\TextColumn::make('commission_bsd')
                    ->alignCenter()
                    ->label('Comision(Bs.)')
                    ->money('VES')
                    ->summarize(Sum::make()
                        ->money('VES')
                        ->label('Total'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('commission_usd')
                    ->alignCenter()
                    ->label('Comision($)')
                    ->money('USD')
                    ->summarize(Sum::make()
                        ->money('USD')
                        ->label('Total'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),


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
                ]),
            ])
            ->striped();
    }

    public static function getRelations(): array
    {
        return [
            //
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
