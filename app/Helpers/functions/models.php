<?php

use App\Models\Block;
use App\Models\Page;
use Illuminate\Support\Collection;

function pageHelper(Page $page): array
{
    return [
        'id' => $page->id,
        'name' => $page->name,
        'slug' => $page->slug,
        'seo' => $page->seo,
        'blocks' => blocksHelper($page->blocks),
    ];
}

/**
 * @param Collection<Block>|null $blocks
 * @return array
 */
function blocksHelper(mixed $blocks): array
{
    if (is_null($blocks)) {
        return [];
    }

    $arr = [];

    foreach ($blocks as $block) {
        $arr[] = [
            'id' => $block->id,
            'name' => $block->name,
            'slug' => $block->slug,
            'content' => blockContentHelper($block->content),
        ];
    }

    return $arr;
}

function blockContentHelper(?array $content): array
{
    if (is_null($content)) {
        return [];
    }

    return array_map(function ($item) {
        if (is_array($item)) {
            return blockContentHelper($item);
        }

        if (is_string($item) && str_starts_with($item, 'blocks/')) {
            return asset('storage/' . $item);
        }

        return $item;
    }, $content);
}
