<?php

use App\Helpers\Filament\FilamentActionHelper;
use App\Helpers\Filament\FilamentFormHelper;
use App\Helpers\Filament\FilamentNotificationHelper;
use App\Helpers\Filament\FilamentTableActionHelper;
use App\Helpers\Filament\FilamentTableHelper;

function filamentFormHelper(): FilamentFormHelper
{
    return new FilamentFormHelper;
}

function filamentTableHelper(): FilamentTableHelper
{
    return new FilamentTableHelper;
}

function filamentActionHelper(): FilamentActionHelper
{
    return new FilamentActionHelper;
}

function filamentTableActionHelper(): FilamentTableActionHelper
{
    return new FilamentTableActionHelper;
}

function filamentNotificationHelper(): FilamentNotificationHelper
{
    return new FilamentNotificationHelper;
}

function filamentFormatLabel($key): string
{
    $parts = explode('.', $key);

    $first = ucfirst($parts[0]);

    $last = $parts[count($parts) - 1];

    if (is_numeric($last)) {
        $first .= ' ' . $last;

        return implode(' ', explode('_', $first));
    }

    return ucfirst(implode(' ', explode('_', $last)));
}
