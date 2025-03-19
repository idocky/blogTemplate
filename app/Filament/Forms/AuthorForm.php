<?php

namespace App\Filament\Forms;

use App\Models\Blog\Author;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AuthorForm
{
    public static function make(): array
    {
	    $helper = filamentFormHelper();

	    return [
		    $helper->input('name'),
		    $helper->input('second_name'),
		    $helper->textarea('description')
			    ->columnSpanFull(),
            $helper->imageV2('image')

	    ];
    }
}
