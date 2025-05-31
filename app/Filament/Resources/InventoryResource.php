<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Inventory;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use App\Filament\Resources\InventoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InventoryResource\RelationManagers;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static ?string $navigationIcon = 'heroicon-s-wallet';

    protected static ?string $navigationGroup = 'Inventario';

    protected static ?string $navigationLabel = 'Inventario';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Section::make('Información del Producto')
                    ->Heading('INVENTARIO CIUDAD ALTERNATIVA')
                    ->description('Formulario para la creacion del producto')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('sku')
                            ->label('SKU')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('code')
                            ->label('Codigo')
                            ->default('CA-' . random_int(11111111, 99999999))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('product')
                            ->label('Articulo')
                            ->required()
                            ->maxLength(255),
                        Select::make('category_id')
                            ->label('Categoría')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('slug')
                                    ->required(),
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('size')
                            ->label('Talla')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('color')
                            ->label('Color')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('price')
                            ->label('Precio')
                            ->required()
                            ->numeric()
                            ->default(0.00)
                            ->prefix('$'),
                        Forms\Components\TextInput::make('quantity')
                            ->label('Cantidad')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('created_by')
                            ->default(Auth::User()->name)
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('image')
                            ->image(),
                    ])
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('product')
                    ->label('Articulo')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('category.name')
                ->label('Categoria')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('size')
                ->label('Talla')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('color')
                ->label('Color')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('model')
                    ->label('Modelo')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('material')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('variation_1')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('variation_2')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('variation_3')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('variation_4')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('variation_5')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('price')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Existencia')
                    ->numeric()
                    ->searchable(isIndividual: true)
                    ->summarize(
                    Sum::make()
                        ->label('Total exitencia')
                        ->numeric()
                ),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagen'),
                // Tables\Columns\TextColumn::make('created_by')
                //     ->searchable(isIndividual: true),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListInventories::route('/'),
            'create' => Pages\CreateInventory::route('/create'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }
}