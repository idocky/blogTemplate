<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Filament\Resources\BlogResource;
use Exception;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ListBlogs extends ListRecords
{
    protected static string $resource = BlogResource::class;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        $helper = filamentTableHelper();
        $action = filamentTableActionHelper();

        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->with(['user']))
            ->columns([
                $helper->text('title')->limit(45),
//                $helper->text('rating.views')
//                    ->alignCenter()
//                    ->label('Views'),
                $helper->text('published_at')
                    ->date('Y-m-d H:i')
                    ->alignCenter(),
                $helper->updated(),
                $helper->created(),
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
        $helper = filamentActionHelper();

        return [
            $helper->createAction(),
        ];
    }
}
