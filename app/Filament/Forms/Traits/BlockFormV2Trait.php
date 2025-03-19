<?php

namespace App\Filament\Forms\Traits;

use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;

trait BlockFormV2Trait
{
    protected function fileUpload(string $model, string $prefix = 'content.', bool $downloadable = true): FileUpload
    {
        return $this->helper
            ->fileUpload("$prefix$model")
            ->downloadable($downloadable)
            ->required()
            ->directory('blocks');
    }

    protected function _fileUpload(string $model, string $prefix = 'content.', bool $downloadable = true): void
    {
        $this->schema[] = $this->fileUpload($model, $prefix, $downloadable);
    }

    protected function image(string $model = 'image', string $prefix = 'content.', bool $required = true): Fieldset
    {
        return $this->helper->fieldset(filamentFormatLabel($model), [
            $this->fileUpload("$model.src", $prefix, false)
                ->image()
                ->required($required),
            $this->helper->input("$prefix$model.alt")->nullable(),
        ]);
    }

    protected function _image(string $model = 'image', string $prefix = 'content.'): void
    {
        $this->schema[] = $this->image($model, $prefix);
    }

    protected function images(string $model = 'images', string $prefix = 'content.'): Repeater
    {
        return $this->helper->repeater("$prefix$model", [
            $this->fileUpload('src', '', false)->image(),
            $this->helper->input('alt')->nullable(),
        ])->required();
    }

    protected function _images(string $model = 'images', string $prefix = 'content.'): void
    {
        $this->schema[] = $this->images($model, $prefix);
    }
}
