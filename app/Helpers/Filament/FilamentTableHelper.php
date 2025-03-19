<?php

namespace App\Helpers\Filament;

use Exception;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class FilamentTableHelper
{
    public function text(string $column): TextColumn
    {
        return TextColumn::make($column);
    }

    public function icon(string $column): IconColumn
    {
        return IconColumn::make($column);
    }

    public function toggle(string $column): ToggleColumn
    {
        return ToggleColumn::make($column);
    }

    public function created(): TextColumn
    {
        return $this->text('created_at')
            ->date('Y-m-d H:i')
            ->label(__('common.created_at'))
            ->alignCenter();
    }

    public function updated(): TextColumn
    {
        return $this->text('updated_at')
            ->date('Y-m-d H:i')
            ->label(__('common.updated_at'))
            ->alignCenter();
    }

    public function selectFilter(string $name): SelectFilter
    {
        try {
            return SelectFilter::make($name);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function ternaryFilter(string $name): TernaryFilter
    {
        try {
            return TernaryFilter::make($name);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
