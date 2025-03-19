<?php

namespace App\Filament\Resources\SubcategoryResource\Pages;

use App\Filament\Resources\SubcategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;

class ListSubcategories extends ListRecords
{
    protected static string $resource = SubcategoryResource::class;

    public function table(Table $table): Table
    {
        $helper = filamentTableHelper();
        $action = filamentTableActionHelper();

        return $table
            ->columns([
                $helper->icon('is_active')
                    ->alignCenter()
                    ->boolean(),
                $helper->text('title'),
                $helper->updated()->label('Last Modified'),
                $helper->created()->label('Created'),
            ])
            ->actions([
                $action->editAction(),
            ])
            ->bulkActions([
                $action->deleteBulkAction(),
            ]);
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
