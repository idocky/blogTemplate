<?php

function request_index_rules(): array
{
    return [
        'page' => ['bail', 'nullable', 'integer', 'min:1'],
        'per_page' => ['bail', 'nullable', 'integer', 'min:1', 'max:500'],
        'created_at' => ['bail', 'nullable', 'boolean',],
        'updated_at' => ['bail', 'nullable', 'boolean',],
    ];
}

function frontendUrl(string $path): string
{
    return trim(config('app.frontend_url'), '/') . $path;
}
