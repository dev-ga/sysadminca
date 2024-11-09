<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-c-user-group';

    protected static ?string $navigationGroup = 'Usuarios';

    protected static ?string $navigationLabel = 'Usuarios';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre y Apellido')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                ->label('Correo Electronico')
                    ->email()
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone')
                    ->label('Telefono')
                    ->tel()
                    ->maxLength(255),

                Forms\Components\TextInput::make('dni')
                    ->label('Cedula de Identidad')
                    ->maxLength(255),

                Forms\Components\TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('role')
                    ->label('Rol')
                    ->default('employee')
                    ->disabled()
                    ->maxLength(255),

                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(User::query()->where('role', 'employee'))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre y Apellido')
                    ->icon('heroicon-c-user-circle')
                    ->iconColor('primary')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dni')
                    ->label('Cedula de Identidad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo Electronico')
                    ->icon('heroicon-m-envelope')
                    ->iconColor('primary')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Tipo de Usuario')
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'employee' => 'success',
                        'costumer' => 'warning',
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->label('Estatus')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
