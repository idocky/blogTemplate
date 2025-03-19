<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

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
