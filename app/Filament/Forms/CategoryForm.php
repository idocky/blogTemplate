<?php

namespace App\Filament\Forms;

use App\Models\Blog\Author;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategoryForm
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

	    ];
    }
}
