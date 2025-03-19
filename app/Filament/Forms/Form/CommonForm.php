<?php

namespace App\Filament\Forms\Form;

use App\Helpers\Filament\FilamentFormHelper;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;

class CommonForm
{
    protected FilamentFormHelper $helper;

    public function __construct(
        protected array $data = [],
    )
    {
        $this->helper = filamentFormHelper();
    }

    public function getSchema(): array
    {
        $schema = [
            $this->helper->input('from')
                ->readOnly(),
            $this->common(),
        ];

        $dimensions = $this->dimensions();

        if ($dimensions) {
            $schema[] = $dimensions;
        }

        return [
            $this->helper->tabs([
                $this->helper->tab('Basic', $schema),
                $this->helper->tab('Files', [
                    $this->helper
                        ->fileUpload('data.files')
                        ->multiple()
                        ->disabled()
                        ->downloadable(),
                ]),
                $this->helper->tab('UTM', [
                    $this->helper->keyValue('utm')
                        ->disabled(),
                ]),
            ])
        ];
    }

    public static function make(array $data = []): array
    {
        return (new static($data))->getSchema();
    }

    protected function common(): Grid
    {
        $keys = $this->data;

        unset($keys['files']);
        unset($keys['agree']);
        unset($keys['dimensions']);

        $grid = [];

        foreach (array_keys($keys) as $key) {
            $grid[] = $this->helper
                ->input('data.' . $key)
                ->readOnly();
        }

        return $this->helper->grid($grid);
    }

    protected function dimensions(): KeyValue|Repeater|null
    {
        $data = $this->data;

        if (is_array($data) && !empty($data['dimensions']) && is_array($data['dimensions'])) {
            $keys = array_keys($data['dimensions']);

            if ($keys[0] === 'a') {
                return $this->helper->keyValue('data.dimensions')->disabled();
            }

            return $this->helper->repeater('data.dimensions', [
                $this->helper->input('widthFt')
                    ->readOnly(),
                $this->helper->input('widthInch')
                    ->readOnly(),
                $this->helper->input('heightFt')
                    ->readOnly(),
                $this->helper->input('heightInch')
                    ->readOnly(),
            ])
                ->columns()
                ->addable(false)
                ->reorderable(false)
                ->deletable(false);
        }

        return null;
    }
}
