<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\BlogResourceForm;
use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog\Blog;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form->schema(BlogResourceForm::form())
            ->columns(1);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
