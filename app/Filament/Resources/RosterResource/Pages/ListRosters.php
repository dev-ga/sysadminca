<?php

namespace App\Filament\Resources\RosterResource\Pages;

use App\Filament\Resources\RosterResource;
use App\Models\Roster;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\DB;

class ListRosters extends ListRecords
{
    protected static string $resource = RosterResource::class;

    protected ?string $heading = 'Modulo de Nomina';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('Calcular Nomina')
            ->form([
                Select::make('date_start')
                    ->label('Author')
                    ->options(User::query()->pluck('name', 'id'))
                    ->required(),
                Select::make('date_start')
                    ->label('Author')
                    ->options(User::query()->pluck('name', 'id'))
                    ->required(),
            ])
            ->action(function () {
                //Realizacion el calculo de la nomina
                $users = DB::table('users')
                ->select('id', 'role', 'status')
                ->where('role', 'employee')
                ->where('status', 1)
                ->get();

                // foreach($users as $user){
                //     $user_sale = DB::table('sales')
                //     ->select(
                //         DB::raw('sum(commission_usd) as total_commission_usd'),
                //         DB::raw('sum(commission_bsd) as total_commission_bsd'),
                //         'user_id'
                //         )->whereBetween('created_at', )
                // }

            }),
        ];
    }
}
