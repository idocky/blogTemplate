<?php

namespace App\Filament\Forms;

use App\Models\Blog\Author;
use App\Models\Blog\Category;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubcategoryForm
{
    public static function make(): array
    {
        $helper = filamentFormHelper();

        return [
            $helper->toggle('is_active')
                ->default(true)
                ->columnSpanFull(),
            $helper->input('title')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(function (Set $set, $state) {
                    $set('slug', Str::slug($state));
                }),
            $helper->input('slug')
                ->required()
                ->unique(ignorable: fn(null|Model $record): null|Model => $record),
            $helper->textarea('description')
                ->columnSpanFull(),
            $helper->select('category_id')
                ->label('Category')
                ->required()
                ->options(Category::all()->pluck('title', 'id')),

        ];
    }
}
