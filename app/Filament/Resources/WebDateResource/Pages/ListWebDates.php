<?php

namespace App\Filament\Resources\WebDateResource\Pages;

use App\Filament\Resources\WebDateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebDates extends ListRecords
{
    protected static string $resource = WebDateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
