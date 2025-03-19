<?php

namespace App\Helpers\Filament;

use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class FilamentNotificationHelper
{
    public function make(string $title)
    {
        return Notification::make()
            ->title($title)
            ->send();
    }

    public function success(string $title): void
    {
        $this->make($title)->success()->send();
    }

    public function action(string $text)
    {
        return Action::make($text);
    }
}
