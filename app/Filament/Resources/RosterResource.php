<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RosterResource\Pages;
use App\Filament\Resources\RosterResource\RelationManagers;
use App\Models\Roster;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RosterResource extends Resource
{
    protected static ?string $model = Roster::class;

    protected static ?string $navigationIcon = 'heroicon-s-book-open';

    protected static ?string $navigationGroup = 'Usuarios';

    protected static ?string $navigationLabel = 'Nomina de Acesores';


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('team')
                    ->searchable(),
                Tables\Columns\TextColumn::make('commision_usd')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('commision_bsd')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount_usd')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount_bsd')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bond_usd')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bond_bsd')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_execution')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_start')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_end')
                    ->searchable(),
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
            'index' => Pages\ListRosters::route('/'),
            'create' => Pages\CreateRoster::route('/create'),
            'edit' => Pages\EditRoster::route('/{record}/edit'),
        ];
    }
}
