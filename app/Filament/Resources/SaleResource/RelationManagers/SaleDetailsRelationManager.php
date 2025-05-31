<?php

namespace App\Filament\Resources\SaleResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class SaleDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'saleDetails';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sale_id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
        ->heading('DETALLES DE LA VENTA')
        ->description('Tabla de detalle de ventas. Contiene todos los articulos agregados a la venta')
            ->recordTitleAttribute('sale_id')
            ->columns([
                Tables\Columns\TextColumn::make('inventory_code')
                    ->label('Codigo de inventario')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sku'),
                Tables\Columns\TextColumn::make('created_by')
                    ->label('Responsable de venta')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'MANUAL' => 'success',
                        'FISCALIZADA' => 'warning',
                    }),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Precio de venta')
                    ->money('USD')
                    ->sortable()->summarize(Sum::make() 
                        ->money('USD')
                        ->label('Total Venta(US$)')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}