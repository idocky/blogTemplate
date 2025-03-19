<?php

namespace App\Filament\Forms\Traits;

use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

trait BlockFormTrait
{
    protected function input(string $model, string $prefix = 'content.'): TextInput
    {
        return $this->helper->input("$prefix$model")
            ->label(filamentFormatLabel($model))
            ->required();
    }

    protected function _input(string $model, string $prefix = 'content.'): void
    {
        $this->schema[] = $this->input($model, $prefix);
    }

    protected function textarea(string $model, string $prefix = 'content.'): Textarea
    {
        return $this->helper->textarea("$prefix$model")
            ->label(filamentFormatLabel($model))
            ->required();
    }

    protected function _textarea(string $model, string $prefix = 'content.'): void
    {
        $this->schema[] = $this->textarea($model, $prefix);
    }

    protected function toggle(string $model, string $prefix = 'content.'): Toggle
    {
        return $this->helper->toggle("$prefix$model")
            ->columnSpanFull()
            ->label(filamentFormatLabel($model))
            ->required();
    }

    protected function _toggle(string $model, string $prefix = 'content.'): void
    {
        $this->schema[] = $this->toggle($model, $prefix);
    }

    protected function select(string $model, string $prefix = 'content.'): Select
    {
        return $this->helper->select("$prefix$model")
            ->label(filamentFormatLabel($model))
            ->required();
    }

    protected function richEditor(string $model, string $prefix = 'content.'): RichEditor
    {
        return $this->helper->richEditor("$prefix$model")
            ->label(filamentFormatLabel($model))
            ->required();
    }

    protected function _richEditor(string $model, string $prefix = 'content.'): void
    {
        $this->schema[] = $this->richEditor($model, $prefix);
    }

    protected function repeater(string $model, array $schema, bool $editable = false, string $prefix = 'content.'): Repeater
    {
        $repeater = $this->helper
            ->repeater("$prefix$model", $schema)
            ->reorderable(false);

        if ($editable) {
            $repeater->required();
        } else {
            $repeater
                ->deletable(false)
                ->addable(false);
        }

        return $repeater;
    }

    protected function simpleRepeater(string $model, mixed $field, bool $editable = false, string $prefix = 'content.'): Repeater
    {
        $repeater = $this->helper
            ->repeaterMake("$prefix$model")
            ->simple($field)
            ->reorderable(false);

        if ($editable) {
            $repeater->required();
        } else {
            $repeater
                ->deletable(false)
                ->addable(false);
        }

        return $repeater;
    }

    protected function _repeater(string $model, array $schema, bool $editable = false, string $prefix = 'content.'): void
    {
        $this->schema[] = $this->repeater($model, $schema, $editable, $prefix);
    }

    protected function _simpleRepeater(string $model, mixed $field, bool $editable = false, string $prefix = 'content.'): void
    {
        $this->schema[] = $this->simpleRepeater($model, $field, $editable, $prefix);
    }

    protected function fieldset(string $header, array $schema, int $columns = 1): Fieldset
    {
        return $this->helper->fieldset(filamentFormatLabel($header), $schema, $columns);
    }

    protected function grid(array $schema, int $columns = 1): Grid
    {
        return $this->helper->grid($schema, $columns);
    }

    protected function _fieldset(string $header, array $schema, int $columns = 1): void
    {
        $this->schema[] = $this->fieldset($header, $schema, $columns);
    }

    protected function _grid(array $schema, int $columns = 1): void
    {
        $this->schema[] = $this->grid($schema, $columns);
    }

    protected function tabs(array $schema): Tabs
    {
        return $this->helper->tabs($schema);
    }

    protected function _tabs(array $schema): void
    {
        $this->schema[] = $this->helper->tabs($schema);
    }

    protected function tab(string $header, array $schema): Tab
    {
        return $this->helper->tab(filamentFormatLabel($header), $schema);
    }

    protected function _header(?int $number = null): void
    {
        if ($number) {
            for ($i = 1; $i <= $number; $i++) {
                $this->schema[] = $this->input("header.$i");
            }
        } else {
            $this->schema[] = $this->input('header');
        }
    }

    protected function _description(): void
    {
        $this->schema[] = $this->textarea('description');
    }

    protected function _hdi(): void
    {
        $this->_header();
        $this->_description();
        $this->_image();
    }

    protected function _points(): void
    {
        $this->schema[] = $this->repeater('points', [
            $this->input('label', ''),
            $this->image('iconSrc', ''),
        ]);
    }

    protected function _keyPlace(string $header = 'header', string $image = 'image', string $items = 'items'): void
    {
        $this->_input($header);
        $this->_image($image);
        $this->_repeater($items, [
            $this->image(prefix: '', required: false),
            $this->input('top', ''),
            $this->input('left', ''),
            $this->input('title', '')->nullable(),
            $this->textarea('text', '')->nullable(),
            $this->toggle('top_corner', '')->nullable(),
            $this->toggle('right_corner', '')->nullable(),
        ], true);
    }

    protected function _keyPlaceArr(string $header = 'header', string $image = 'image', string $items = 'items', string $prefix = 'content.'): array
    {
        return [
            $this->input($header, $prefix),
            $this->image($image, $prefix),
            $this->repeater($items, [
                $this->image('image', ''),
                $this->input('top', ''),
                $this->input('left', ''),
                $this->input('title', '')->nullable(),
                $this->textarea('text', '')->nullable(),
                $this->toggle('top_corner', '')->nullable(),
                $this->toggle('right_corner', '')->nullable(),
            ], true, $prefix),
        ];
    }


}
