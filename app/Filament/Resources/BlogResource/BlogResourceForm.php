<?php

namespace App\Filament\Resources\BlogResource;

use App\Models\Blog\Blog;
use App\Models\User;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Blog\Author;
use App\Models\Blog\Category;
use App\Models\Blog\Subcategory;

class BlogResourceForm
{
    public static function form(): array
    {
        $helper = filamentFormHelper();

        $content = [
            $helper->repeater('content', [
                $helper->grid([
                    $helper->select('header_type')
                        ->columnSpanFull()
                        ->options([
                            //1 => 'Light & Bold',
                            2 => 'Blue',
                            //3 => 'List Item',
                        ])
                        ->reactive(),
                    $helper->input('light_header')
                        ->columnSpan(2)
                        ->hidden(fn(Get $get) => $get('header_type') != 1),
                    $helper->input('bold_header')
                        ->columnSpan(2)
                        ->hidden(fn(Get $get) => $get('header_type') != 1),
                    $helper->input('blue_header')
                        ->columnSpanFull()
                        ->hidden(fn(Get $get) => $get('header_type') != 2),
                    $helper->input('number_header')
                        ->numeric()
                        ->minValue(1)
                        ->columnSpan(1)
                        ->hidden(fn(Get $get) => $get('header_type') != 3),
                    $helper->input('list_header')
                        ->columnSpan(3)
                        ->hidden(fn(Get $get) => $get('header_type') != 3),
                ], 4),
                $helper->richEditor('content')
                    ->toolbarButtons([
                        'bold',
                        'bulletList',
                        'italic',
                        'link',
                        'orderedList',
                        'strike',
                        'underline',
                    ])
                    ->columnSpanFull(),
            ])
                ->disableItemCreation()
                ->required()
                ->columns(),
        ];

        return [
            $helper->tabs([
                $helper->tab('Basic', [
                    $helper->grid([
                        $helper->input('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))
                            ),
                        $helper->input('slug')
                            ->required()
                            ->unique(ignorable: fn(null|Model $record): null|Model => $record),
                        $helper->select('author_id')
                            ->label('Author')
                            ->required()
                            ->options(Author::all()->pluck('name', 'id')),
                        $helper->select('category_id')
                            ->label('Category')
                            ->required()
                            ->options(Category::all()->pluck('title', 'id')),
//                        $helper->dateTime('published_at'),
                        $helper->textarea('description')
                            ->columnSpanFull(),
                        $helper->textarea('short_description')
                            ->label('Short Description')
                            ->columnSpanFull(),
                        $helper->input('reading_duration')
                            ->numeric()
                            ->minValue(1)
                            ->columnSpan(1),
                        $helper->select('subcategories')
                            ->searchable()
                            ->getSearchResultsUsing(fn(string $search): array => Subcategory::where('title', 'like', "%$search%")
                                ->limit(40)
                                ->pluck('title', 'id')
                                ->toArray()
                            )
                            ->getOptionLabelUsing(fn($value): ?string => Subcategory::find($value)?->title)
                            ->label('Subcategories')
                            ->multiple()
                            ->mutateDehydratedStateUsing(function ($state) {
                                return is_array($state) ? array_map('intval', $state) : (int) $state;
                            })
                            ->columnSpanFull(),
                        $helper->repeater('images', $helper->imageV2(fieldset: false, directory: 'blog'))
                            ->required()
                            ->columnSpanFull()
                            ->disableItemCreation(),
                    ]),
                ]),
                $helper->tab('Content', [
                    $helper->builder('content', [
                        $helper->builderBlock(1, $content)
                            ->label('Headers and Texts'),
//                        $helper->builderBlock(2, [
//                            $helper->tabs([
//                                $helper->tab('Content', [
//                                    $helper->select('position')
//                                        ->default('right')
//                                        ->options([
//                                            'right' => 'Right',
//                                            'left' => 'Left',
//                                        ]),
//                                    ...$content,
//                                ]),
//                                $helper->tab('Images', [
//                                    $helper->repeater('images', $helper->imageV2(fieldset: false, directory: 'blog'))
//                                        ->maxItems(1)
//                                        ->required()
//                                        ->columnSpanFull(),
//                                ]),
//                            ]),
//                        ])
//                            ->label('Headers, Texts and Images'),
//                        $helper->builderBlock(3, [
//                            $helper->tabs([
//                                $helper->tab('Content', [
//                                    $helper->select('position')
//                                        ->default('right')
//                                        ->options([
//                                            'right' => 'Right',
//                                            'left' => 'Left',
//                                        ]),
//                                    ...$content,
//                                ]),
//                                $helper->tab('Video', [
//                                    $helper->fileUpload('video')
//                                        ->directory('blog')
//                                        ->acceptedFileTypes(['video/*'])
//                                        ->required()
//                                        ->columnSpanFull(),
//                                ]),
//                            ]),
//                        ])
//                            ->label('Headers, Text and Video'),
                        $helper->builderBlock(4, [
                            $helper->repeater('', $helper->imageV2(fieldset: false, directory: 'blog'))
                                ->required()
                                ->disableItemCreation()
                                ->columnSpanFull(),
                        ])->label('Big Images')->columns(),
//                        $helper->builderBlock(5, [
//                            $helper->repeater('', $helper->imageV2(fieldset: false, directory: 'blog'))
//                                ->required()
//                                ->columnSpanFull(),
//                        ])->label('Images (Auto)')->columns(),
//                        $helper->builderBlock(6, [
//                            $helper->fileUpload('')
//                                ->directory('blog')
//                                ->acceptedFileTypes(['video/*'])
//                                ->required()
//                                ->columnSpanFull(),
//                        ])->label('Video (File)')->columns(),
//                        $helper->builderBlock(7, [
//                            $helper->input('src')->required()->url(),
//                            $helper->imageV2('image', directory: 'blog'),
//                        ])->label('Video (Source)'),
                    ])->required(),
                ]),
//                $helper->tab('FAQ', [
//                    $helper->input('faq.header'),
//                    $helper->repeater('faq.items', [
//                        $helper->input('question')->required(),
//                        $helper->textarea('answer')->required(),
//                    ])->defaultItems(0),
//                ]),
                $helper->tab('SEO', [
                    $helper->input('seo.title')
                        ->required(),
                    $helper->textarea('seo.description')
                        ->required(),
                    $helper->tags('seo.keywords')
                        ->required(),
//                    $helper->repeater('seo.breadcrumbs', [
//                        $helper->input('name')->required(),
//                        $helper->input('url')->required(),
//                    ]),
                ]),
            ])
        ];
    }
}
