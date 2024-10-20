<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyClosingResource\Pages;
use App\Filament\Resources\DailyClosingResource\RelationManagers;
use App\Models\DailyClosing;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DailyClosingResource extends Resource
{
    protected static ?string $model = DailyClosing::class;

    protected static ?string $navigationIcon = 'heroicon-s-clipboard-document-list';

    protected static ?string $navigationGroup = 'Ventas';

    protected static ?string $navigationLabel = 'Cierres de Caja';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->maxLength(255),
                Forms\Components\TextInput::make('ref_debito')
                    ->maxLength(255),
                Forms\Components\TextInput::make('ref_credito')
                    ->maxLength(255),
                Forms\Components\TextInput::make('ref_visaMaster')
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount_debito')
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('amount_credito')
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('amount_visaMaster')
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('total_efectivo_usd')
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('total_efectivo_bsd')
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('total_zelle')
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('total_banesco_panama')
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('total_pago_movil')
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('created_by')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ref_debito')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ref_credito')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ref_visaMaster')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount_debito')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_credito')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_visaMaster')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_efectivo_usd')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_efectivo_bsd')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_zelle')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_banesco_panama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_pago_movil')
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
            'index' => Pages\ListDailyClosings::route('/'),
            'create' => Pages\CreateDailyClosing::route('/create'),
            'edit' => Pages\EditDailyClosing::route('/{record}/edit'),
        ];
    }
}
