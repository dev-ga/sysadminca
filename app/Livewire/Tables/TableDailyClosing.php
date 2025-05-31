<?php

namespace App\Livewire\Tables;

use App\Models\DailyClosing;
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
use Livewire\Attributes\On;
use Filament\Tables\Columns\TextColumn;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use WireUi\Traits\Actions;
use Filament\Tables\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Support\RawJs;
use Filament\Forms\Components\Textarea;

class TableDailyClosing extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    #[On('daily-closing-updated')]
    public function updateDailyClosing()
    {
        $this->reset();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(DailyClosing::query()->whereBetween('created_at', [date('Y-m-d').' 09:00:00.000', date('Y-m-d').' 23:00:00.000'])->orderBy('id', 'desc'))
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Codigo')
                    ->color('success')
                    ->icon('heroicon-c-tag')
                    ->searchable(),
                Tables\Columns\TextColumn::make('store')
                    ->label('Tienda')
                    ->color('success')
                    ->icon('heroicon-s-building-library')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount_debito')
                    ->color('info')
                    ->description(fn (DailyClosing $record): string => '#Lote: '.$record->ref_debito)
                    ->icon('heroicon-s-building-library')
                    ->label('Monto Debito')
                    ->money('VES')
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_credito')
                    ->color('info')
                    ->description(fn (DailyClosing $record): string => '#Lote: '.$record->ref_credito)
                    ->icon('heroicon-s-building-library')
                    ->label('Monto Credito')
                    ->money('VES')
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_visaMaster')
                    ->color('info')
                    ->description(fn (DailyClosing $record): string => '#Lote: '.$record->ref_visaMaster)
                    ->icon('heroicon-s-building-library')
                    ->label('Monto Visa/Master')
                    ->money('VES')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_pago_movil')
                    ->color('info')
                    ->icon('heroicon-s-building-library')
                    ->label('Pago Movil')
                    ->money('VES')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_zelle')
                    ->color('success')
                    ->icon('heroicon-s-currency-dollar')
                    ->label('Zelle')
                    ->money('USD')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_banesco_panama')
                    ->color('success')
                    ->icon('heroicon-s-currency-dollar')
                    ->label('Banesco Panama')
                    ->money('USD')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_efectivo_usd')
                    ->color('success')
                    ->icon('heroicon-s-currency-dollar')
                    ->label('Efectivo USD')
                    ->money('USD')
                    ->summarize(Sum::make()
                        ->money('USD')
                        ->label('Total en Caja($)'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_by')
                    ->color('primary')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            // ->headerActions([
            //     CreateAction::make()
            //     ->model(DailyClosing::class)
            //     ->form([
            //         Section::make('Formulario')
            //             ->description('Debe llenar los campos de forma correta')
            //             ->icon('heroicon-s-newspaper')
            //             ->schema([
            //                 Grid::make()
            //                 ->schema([

            //                     //Debito
            //                     TextInput::make('ref_debito')
            //                         ->label('Ref. Debito')
            //                         ->prefixIcon('heroicon-c-hashtag')
            //                         ->mask(RawJs::make(<<<'JS'
            //                             $input.startsWith('34') || $input.startsWith('37') ? '999999' : '999999'
            //                         JS))
            //                         ->numeric(),
            //                     TextInput::make('monto_ref_debito')
            //                         ->label('Monto Debito')
            //                         ->prefixIcon('heroicon-s-building-library')
            //                         ->mask(RawJs::make(<<<'JS'
            //                             $money($input, ',')
            //                         JS)),

            //                     //Credito
            //                     TextInput::make('ref_credito')
            //                         ->label('Ref. Credito')
            //                         ->prefixIcon('heroicon-c-hashtag')
            //                         ->mask(RawJs::make(<<<'JS'
            //                             $input.startsWith('34') || $input.startsWith('37') ? '999999' : '999999'
            //                         JS))
            //                         ->numeric(),
            //                     TextInput::make('monto_ref_credito')
            //                         ->label('Monto Credito')
            //                         ->prefixIcon('heroicon-s-building-library')
            //                         ->mask(RawJs::make(<<<'JS'
            //                             $money($input, ',')
            //                         JS)),

            //                     //Vida/Master
            //                     TextInput::make('ref_visaMaster')
            //                         ->label('Ref. Visa/Master')
            //                         ->prefixIcon('heroicon-c-hashtag')
            //                         ->mask(RawJs::make(<<<'JS'
            //                             $input.startsWith('34') || $input.startsWith('37') ? '999999' : '999999'
            //                         JS))
            //                         ->numeric(),

            //                     TextInput::make('monto_ref_visaMaster')
            //                         ->label('Monto Visa/Master')
            //                         ->prefixIcon('heroicon-s-building-library')
            //                         ->mask(RawJs::make(<<<'JS'
            //                             $money($input, ',')
            //                         JS)),
            //                     // ...
            //                 ]),
            //             Textarea::make('observaciones')
            //             ->autosize()

            //             ])
            //     ])
            //     ->action(function (array $data) {
            //         CierreDiarioController::cierreDiario(
            //             $data['ref_debito'],
            //             $data['monto_ref_debito'],
            //             $data['ref_credito'],
            //             $data['monto_ref_credito'],
            //             $data['ref_visaMaster'],
            //             $data['monto_ref_visaMaster'],
            //             $data['observaciones']);

            //     })
            // ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.tables.table-daily-closing');
    }
}
