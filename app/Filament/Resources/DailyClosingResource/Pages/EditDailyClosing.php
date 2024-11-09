<?php

namespace App\Filament\Resources\DailyClosingResource\Pages;

use App\Filament\Resources\DailyClosingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyClosing extends EditRecord
{
    protected static string $resource = DailyClosingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
