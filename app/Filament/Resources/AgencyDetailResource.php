<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgencyDetailResource\Pages;
use App\Filament\Resources\AgencyDetailResource\RelationManagers;
use App\Models\Agency;
use App\Models\AgencyDetail;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgencyDetailResource extends Resource
{
    protected static ?string $model = AgencyDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Configuracion General';

    protected static ?string $navigationLabel = 'Detalle de Agencias';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('agency_id')
                ->label('Agencia de Envio')
                    ->options(Agency::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Select::make('state_id')
                    ->label('Estado')
                    ->options(State::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                TextInput::make('name')
                ->label('Nombre-Razón Social')
                        ->maxLength(255),
                TextInput::make('code')
                    ->label('Código de Agencia')
                    ->maxLength(255),
                TextInput::make('address')
                    ->label('Direccion')
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                TextInput::make('website')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(AgencyDetail::query()->orderBy('created_at', 'desc'))
            ->columns([
                Tables\Columns\TextColumn::make('agency.name')
                    ->label('Agencia de Envio')
                    ->icon('heroicon-c-home-modern')
                    ->iconColor('primary')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Codigo')
                    ->icon('heroicon-o-ticket')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Direccion')
                    ->icon('heroicon-c-map-pin')
                    ->searchable(),
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
            'index' => Pages\ListAgencyDetails::route('/'),
            'create' => Pages\CreateAgencyDetail::route('/create'),
            'edit' => Pages\EditAgencyDetail::route('/{record}/edit'),
        ];
    }
}
