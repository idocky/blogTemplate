<?php

require_once 'Filament/functions.php';
require_once 'functions/request.php';
require_once 'functions/models.php';

function convertArrayToIntegers($array): array
{
    return array_map(fn($value) => intval($value), $array);
}

function getImage(string $image): string
{
    if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
        return $image;
    } else {
        return asset('storage/' . $image);
    }
}

function getImageV2(array $image): array
{
    $image['src'] = getImage($image['src']);

    return $image;
}

function getImagesV2(?array $images): array
{
    $array = [];

    foreach ($images ?? [] as $image) {
        $array[] = getImageV2($image);
    }

    return $array;
}

function tu(string $string, ?array $data = null): array
{
    if (is_null($data)) {
        $data = [];
    }

    $data['src'] = $string;
    $data['alt'] = basename(parse_url($string, PHP_URL_PATH));

    return $data;
}

function formatLabel(?string $value): string
{
    return ucfirst(implode(' ', explode('_', $value ?? '')));
}
