<?php

namespace App\Filament\Forms\Form;

use App\Helpers\Filament\FilamentFormHelper;
use Filament\Forms\Components\Fieldset;

class QuizForm
{
    protected FilamentFormHelper $helper;

    public function __construct(
        protected array $data = [],
    )
    {
        $this->helper = filamentFormHelper();
    }

    public static function make(array $data = []): array
    {
        return (new static($data))->getSchema();
    }

    public function getSchema(): array
    {
        return [
            $this->helper->tabs([
                $this->helper->tab('Basic', [
                    $this->helper->input('from')->readOnly(),
                    $this->contact(),
                    $this->answer(),
                ]),
                $this->helper->tab('Files', [
                    $this->helper
                        ->fileUpload('data.files')
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

    protected function contact(): Fieldset
    {
        $data = $this->data;

        $schema = [];

        if (!empty($data['contact']) && is_array($data['contact'])) {
            foreach (array_keys($data['contact']) as $contact) {
                $schema[] = $this->helper->input('data.contact.' . $contact);
            }
        }

        return $this->helper->fieldset('Contact', $schema, 2);
    }

    protected function answer(): Fieldset
    {
        $data = $this->data;

        $schema = [];

        if (!empty($data['answer']) && is_array($data['answer'])) {
            $index = 1;

            foreach ($data['answer'] as $value) {
                $value = array_map('trim', explode('||', $value));

                $schema[] = $this->helper
                    ->input('data.data.' . $index)
                    ->label($value[0])
                    ->formatStateUsing(fn() => $value[1]);

                $index++;
            }
        }

        return $this->helper->fieldset('Answer', $schema);
    }
}
