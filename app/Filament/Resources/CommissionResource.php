<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommissionResource\Pages;
use App\Filament\Resources\CommissionResource\RelationManagers;
use App\Models\Commission;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommissionResource extends Resource
{
    protected static ?string $model = Commission::class;

    protected static ?string $navigationIcon = 'heroicon-s-document-currency-dollar';

    protected static ?string $navigationGroup = 'Configuracion General';

    protected static ?string $navigationLabel = 'Comiciones';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('aplication')
                    ->label('Aplicacion')
                    ->options([
                        'on-line' => 'ON-LINE',
                        'piso-de-venta' => 'Piso de Venta',
                    ])
                    ->required(),

                Select::make('user_id')
                    ->label('Usuario')
                    ->relationship('user', 'name')
                    ->required(),

                Select::make('type_user')
                    ->label('Rol')
                    ->options([
                        'employee' => 'Empleado',
                        'store-manager' => 'Gerente de tienda',
                    ])
                    ->required(),

                TextInput::make('porcent')
                    ->label('Porcentaje')
                    ->required()
                    ->numeric(),

                TextInput::make('status')
                    ->label('Estatus')
                    ->disabled()
                    ->required()
                    ->maxLength(255)
                    ->default('activo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('aplication')
                ->label('Aplicacion')
                ->icon('heroicon-c-swatch')
                ->color('success')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('user.name')
                // ->label('Usuario')
                // ->icon('heroicon-m-user-circle')
                // ->color('warning')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('type_user')
                    ->label('Rol')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('porcent')
                    ->label('Porcentaje')
                    ->icon('heroicon-c-receipt-percent')
                    ->color('success')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                ->label('Fecha de creación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                ->label('Fecha de actualización')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListCommissions::route('/'),
            'create' => Pages\CreateCommission::route('/create'),
            'edit' => Pages\EditCommission::route('/{record}/edit'),
        ];
    }
}
