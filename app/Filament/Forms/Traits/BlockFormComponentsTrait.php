<?php

namespace App\Filament\Forms\Traits;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;

trait BlockFormComponentsTrait
{
    protected function text(string $model = 'text', string $prefix = 'content.'): Textarea
    {
        return $this->helper->textarea("$prefix$model")->required();
    }

    protected function _text(string $model = 'text', string $prefix = 'content.'): void
    {
        $this->schema[] = $this->text($model, $prefix);
    }

    protected function list(string $model = 'list', string $prefix = 'content.'): Repeater
    {
        return $this->helper
            ->repeaterMake("$prefix$model")
            ->simple($this->helper->input('text')->required())
            ->required()
            ->reorderable(false);
    }

    protected function _list(string $model = 'list', string $prefix = 'content.'): void
    {
        $this->schema[] = $this->list($model, $prefix);
    }

    protected function _markers(): void
    {
        $this->_fieldset('Map', [
            $this->input('map.url')->nullable(),
            $this->input('map.lat')->numeric(),
            $this->input('map.lng')->numeric(),
        ]);

        $this->schema[] = $this->repeater('markers', [
            $this->input('name', ''),
            $this->input('url', '')->nullable(),
            $this->input('lat', '')->numeric(),
            $this->input('lng', '')->numeric(),
            $this->toggle('open', '')
                ->columnSpan(1),
            $this->toggle('showroom', '')
                ->columnSpan(1),
            $this->input('email', ''),
            $this->input('phone', ''),
            $this->input('address', ''),
            $this->input('work_time', ''),
        ], true)->columns();
    }

    protected function _videos1(string $model = 'items'): void
    {
        $this->schema[] = $this->repeater($model, [
            $this->input('title', ''),
            $this->input('iframe', ''),
            $this->input('time', ''),
            $this->image(prefix: ''),
        ], true);
    }

    protected function _videos2(string $model = 'items'): void
    {
        $this->schema[] = $this->repeater($model, [
            $this->input('name', ''),
            $this->input('slug', ''),
            $this->input('time', ''),
            $this->input('video', ''),
            $this->image(prefix: ''),
        ], true);
    }
}
