<?php

namespace App\Filament\Forms;

use App\Filament\Forms\Traits\BlockFormComponentsTrait;
use App\Filament\Forms\Traits\BlockFormTrait;
use App\Filament\Forms\Traits\BlockFormV2Trait;
use App\Helpers\Filament\FilamentFormHelper;
use App\Models\Block;
use App\Models\Blog\Blog;

class BlockForm
{
    use BlockFormTrait, BlockFormV2Trait, BlockFormComponentsTrait;

    protected array $schema = [];

    protected FilamentFormHelper $helper;

    protected string $slug;

    public function __construct()
    {
        $this->helper = filamentFormHelper();
    }

    public static function make(): callable
    {
        $el = new static();

        return $el->form();
    }

    public function form(): callable
    {
        return function (Block $record) {
            $this->slug = $record->slug;

//            dd($record->slug, $record->content);

            $this->schema = [];

            $this->_input('name', '');

            if (str_starts_with($this->slug, 'home_')) {
                $this->formHome();
            } else if (str_starts_with($this->slug, 'glass-partitions')) {
                $this->formGlassPartitions();
            } else if (str_starts_with($this->slug, 'products_')) {
                $this->formProducts();
            } else if (str_starts_with($this->slug, 'custom-steel-glass-partitions_')) {
                $this->formCustomSteelGlassPartitions();
            } else if (str_starts_with($this->slug, 'aluminum-glass-partitions_')) {
                $this->formAluminumGlassPartitions();
            } else if (str_starts_with($this->slug, 'frameless-sliding-glass-wall_')) {
                $this->formFramelessSlidingGlassWall();
            } else if (str_starts_with($this->slug, 'frameless-glass-partitions_')) {
                $this->formFramelessGlassPartitions();
            } else if (str_starts_with($this->slug, 'glass-partition-wall-systems-for-home_')) {
                $this->formGlassPartitionWallSystemsForHomeOrOffice('home');
            } else if (str_starts_with($this->slug, 'glass-partition-wall-systems-for-office_')) {
                $this->formGlassPartitionWallSystemsForHomeOrOffice('office');
            } else if (str_starts_with($this->slug, 'about_')) {
                $this->formAbout();
            } else if (str_starts_with($this->slug, 'we-install_')) {
                $this->formWeInstall();
            } else if (str_starts_with($this->slug, 'partnership_')) {
                $this->formBecomeAPartner();
            } else if (str_starts_with($this->slug, 'contact_')) {
                $this->formContact();
            } else if (str_starts_with($this->slug, 'we-deliver_')) {
                $this->formWeDeliver();
            } else if (str_starts_with($this->slug, 'installation_')) {
                $this->formInstallationGuide();
            } else if (str_starts_with($this->slug, 'iron-doors_')) {
                $this->formIronDoors();
            } else if (str_starts_with($this->slug, 'select-product_')) {
                $this->formSelectProduct();
            } else if (str_starts_with($this->slug, 'thank-u-page_')) {
                $this->formThankYou();
            } else if (str_starts_with($this->slug, 'privacy-policy_')) {
                $this->formPrivacyPolicy();
            } else if (str_starts_with($this->slug, 'blog_')) {
                $this->formBlog();
            } else if (str_starts_with($this->slug, 'gallery_')) {
                $this->formGallery();
            } else if (str_starts_with($this->slug, 'typical-details_')) {
                $this->formTypicalDetails();
            } else if (str_starts_with($this->slug, 'career_')) {
                $this->formCareer();
            } else if (str_starts_with($this->slug, 'b2b_')) {
                $this->formB2b();
            } else if (str_starts_with($this->slug, 'modular-system_')) {
                $this->formModularSystem();
            } else if (str_starts_with($this->slug, 'dealership_')) {
                $this->formDealership();
            } else if (str_starts_with($this->slug, 'aluminum-framed-glass-partitions_')) {
                $this->formAluminumFramedGlassPartitions();
            } else if (str_starts_with($this->slug, 'common_')) {
                $this->formCommon();
            } else if (str_starts_with($this->slug, 'video_')) {
                $this->formVideo();
            } else if (str_starts_with($this->slug, 'showroom_')) {
                $this->formShowroom();
            }

            return $this->schema;
        };
    }

    protected function formCommon(): void
    {
        if ($this->slug == 'common_1') {
            $this->_input('header_1');
            $this->_input('header_2');

            $this->_repeater('items', [
                $this->input('url', ''),
                $this->input('header1', ''),
                $this->input('header2', ''),
                $this->image(prefix: ''),
                $this->image('image_mobile', ''),
            ], true);
        } else if ($this->slug == 'common_2') {
            $this->_input('header_1');
            $this->_input('header_2');
            $this->_input('button');

            $this->_videos1('clients');
        } else if ($this->slug == 'common_3') {
            $this->_input('header1');
            $this->_input('header2');

            $this->_repeater('facts', [
                $this->input('text', ''),
                $this->input('count', ''),
            ]);

            $this->_repeater('brands', [
                $this->input('name', ''),
                $this->image(prefix: ''),
            ]);
        } else if ($this->slug == 'common_4') {
            $this->_header();
            $this->_markers();
        } else if ($this->slug == 'common_5') {
            $this->_header(2);
            $this->_repeater('items', [
                $this->input('name', ''),
                $this->image(prefix: ''),
            ]);
        }
    }

    protected function formHome(): void
    {
        if ($this->slug == 'home_1') {
            $this->_hdi();
        } else if ($this->slug == 'home_2') {
            $this->_header();

            $this->_repeater('items', [
                $this->input('header', ''),
                $this->textarea('text', ''),
            ]);

            $this->_fieldset('Banner', [
                $this->input('banner.header.1'),
                $this->input('banner.header.2'),
                $this->input('banner.button.1'),
                $this->input('banner.button.2'),
            ], columns: 2);
        } else if ($this->slug == 'home_3') {
            $this->_simpleRepeater('items', $this->input('portfolio_item_code', ''), true);
        }
    }

    protected function formGlassPartitions(): void
    {
        if ($this->slug == 'glass-partitions_1') {
            $this->_hdi();
            $this->_image('image_mobile');
            $this->_points();
        } else if ($this->slug == 'glass-partitions_2') {
            $this->_input('header.1');
            $this->_input('header.2');

            $this->_repeater('items', [
                $this->input('url', ''),
                $this->input('title', ''),
                $this->input('subtitle', ''),
                $this->image(prefix: ''),
                $this->image('image_mobile', ''),
            ]);

            $this->_fieldset('Last Item', [
                $this->input('url', 'content.last_item.'),
                $this->input('title', 'content.last_item.'),
                $this->input('subtitle', 'content.last_item.'),
                $this->image('image', 'content.last_item.'),
            ]);
        } else if ($this->slug == 'glass-partitions_3') {
            $this->_image();

            $this->_input('header.1');
            $this->_input('header.2');

            $this->_input('questions');
            $this->_input('time');
        } else if ($this->slug == 'glass-partitions_4') {
            $this->_simpleRepeater('items', $this->input('portfolio_item_code', ''), true);
        } else if ($this->slug == 'glass-partitions_5') {
            $this->_repeater('items', [
                $this->image('left', ''),
                $this->image('right', ''),
            ], true);
        } else if ($this->slug == 'glass-partitions_6') {
            $this->_header();

            $this->_repeater('items', [
                $this->input('header', ''),
                $this->input('text', ''),
            ], true);

            $this->_fieldset('Banner', [
                $this->input('banner.header.1'),
                $this->input('banner.header.2'),
                $this->input('banner.button.1'),
                $this->input('banner.button.2'),
            ], columns: 2);
        }
    }

    protected function formProducts(): void
    {
        if ($this->slug == 'products_header') {
            $this->_header();
        } else if ($this->slug == 'products_items') {
            $this->_repeater('content', [
                $this->input('title', ''),
                $this->image(prefix: ''),
                $this->input('btn_1_link', ''),
                $this->input('btn_2_text', ''),
                $this->input('btn_1_link', ''),
                $this->input('btn_2_text', ''),
            ], prefix: '');
        }
    }

    protected function formCustomSteelGlassPartitions(): void
    {
        if ($this->slug == 'custom-steel-glass-partitions_header') {
            $this->_image();
            $this->_image('image_mobile');
            $this->_header();
            $this->_input('btn_title');
        } else if ($this->slug == 'custom-steel-glass-partitions_variations') {
            $tabs = [];

            foreach (['swing', 'sliding', 'bi_folding', 'stationary'] as $str) {
                $schema = [];

                $schema[] = $this->fieldset('preview', [
                    $this->input('title', "content.$str.preview."),
                    $this->image('image', "content.$str.preview."),
                    $this->input('btn_link_1', "content.$str.preview."),
                    $this->input('btn_link_2', "content.$str.preview."),
                    $this->simpleRepeater('paragraphs', $this->textarea('text', ''), prefix: "content.$str.preview."),
                    $this->input('title_bold', "content.$str.preview."),
                    $this->input('btn_title_1', "content.$str.preview."),
                    $this->input('btn_title_2', "content.$str.preview."),
                    $this->richEditor('description', "content.$str.preview."),
                ]);

                $schema[] = $this->fieldset('key_place', [
                    $this->image('image', "content.$str.key_place."),
                    $this->input('title', "content.$str.key_place."),
                    $this->input('tip_text', "content.$str.key_place."),
                    $this->repeater('dots', [
                        $this->image(prefix: ''),
                        $this->input('top', ''),
                        $this->input('left', ''),
                        $this->input('title', '')->nullable(),
                        $this->textarea('text', '')->nullable(),
                        $this->toggle('top_corner', '')->nullable(),
                        $this->toggle('right_corner', '')->nullable(),
                    ], true, "content.$str.key_place."),
                ]);

                $schema[] = $this->fieldset('menu_item', [
                    $this->image('image', "content.$str.menu_item."),
                    $this->input('slug', "content.$str.menu_item."),
                    $this->input('title', "content.$str.menu_item."),
                ]);

                $schema[] = $this->fieldset('calculations', [
                    $this->image('image', "content.$str.calculations."),
                    $this->input('btn_link', "content.$str.calculations."),
                    $this->input('btn_text', "content.$str.calculations."),
                    $this->input('title_bold', "content.$str.calculations."),
                    $this->repeater('items', [
                        $this->image(prefix: ''),
                        $this->input('title', ''),
                        $this->textarea('description', ''),
                    ], prefix: "content.$str.calculations."),
                ]);

                if (in_array($str, ['swing', 'sliding'])) {
                    $schema[] = $this->fieldset('types_of_handles', [
                        $this->input('title_bold', "content.$str.types_of_handles."),
                        $this->input('title', "content.$str.types_of_handles."),
                        $this->repeater('items', [
                            $this->image(prefix: ''),
                            $this->input('title', ''),
                        ], prefix: "content.$str.types_of_handles."),
                    ]);
                }

                $schema[] = $this->fieldset('system_configuration', [
                    $this->input('title_bold', "content.$str.system_configuration."),
                    $this->input('title', "content.$str.system_configuration."),
                    $this->repeater('items', [
                        $this->image(prefix: ''),
                        $this->repeater('title', [
                            $this->toggle('blue', ''),
                            $this->input('text', ''),
                        ],  true, ''),
                    ],  true, "content.$str.system_configuration."),
                ]);

                $tabs[] = $this->helper->tab(filamentFormatLabel($str), $schema);
            }

            $this->schema[] = $this->helper->tabs($tabs);
        } else if ($this->slug == 'custom-steel-glass-partitions_bottom') {
            $this->_input('title_bold');
            $this->_input('title');
            $this->_richEditor('description');
            $this->_repeater('items', [
                $this->image(prefix: ''),
                $this->input('title', ''),
                $this->textarea('description', ''),
            ]);
        } else if ($this->slug == 'custom-steel-glass-partitions_glass_finishes') {
            $this->_repeater('items', [
                $this->image(prefix: ''),
                $this->input('title', ''),
                $this->fieldset('detail', [
                    $this->input('color', 'detail.'),
                    $this->input('pattern', 'detail.'),
                    $this->input('privacy', 'detail.'),
                ]),
            ]);
        } else if ($this->slug == 'custom-steel-glass-partitions_projects') {
            $this->_simpleRepeater('items', $this->input('portfolio_item_code', ''), true);
        }
    }

    protected function formAluminumGlassPartitions(): void
    {
        if ($this->slug == 'aluminum-glass-partitions_1') {
            $this->_header();
            $this->_image();
            $this->_image('image_mobile');
            $this->_textarea('text');
            $this->_input('button');
        } else if ($this->slug == 'aluminum-glass-partitions_2') {
            $this->_input('header.1');
            $this->_input('header.2');
            $this->_images();
            $this->_input('button');
            $this->_simpleRepeater('list', $this->textarea('text', ''), true);
        } else if ($this->slug == 'aluminum-glass-partitions_3') {
            $this->_keyPlace('title', 'keyImg', 'dots');
        } else if ($this->slug == 'aluminum-glass-partitions_4') {
            $this->_repeater('items', [
                $this->input('name', ''),
                $this->image(prefix: ''),
            ]);
        } else if ($this->slug == 'aluminum-glass-partitions_5') {
            $this->_header();
            $this->_repeater('items', [
                $this->input('name', ''),
                $this->image(prefix: ''),
                $this->input('content.0', ''),
                $this->input('content.1', ''),
                $this->input('content.2', ''),
                $this->input('content.3', ''),
                $this->select('color', '')
                    ->options([
                        1 => 'Color 1',
                        2 => 'Color 2',
                        3 => 'Color 3',
                        4 => 'Color 4',
                    ])
                    ->multiple(),
            ], true);
        } else if ($this->slug == 'aluminum-glass-partitions_6') {
            $this->_header();
            $this->_repeater('items', [
                $this->input('name.1', ''),
                $this->input('name.2', ''),
                $this->image(prefix: ''),
                $this->select('color', '')
                    ->options([
                        1 => 'Color 1',
                        2 => 'Color 2',
                        3 => 'Color 3',
                    ])
                    ->multiple(),
            ], true);
        } else if ($this->slug == 'aluminum-glass-partitions_7') {
            $this->_input('header.1');
            $this->_input('header.2');
            $this->_repeater('items', [
                $this->input('type', ''),
                $this->repeater('items', [
                    $this->input('name', ''),
                    $this->image(prefix: ''),
                ], prefix: ''),
            ]);
        } else if ($this->slug == 'aluminum-glass-partitions_8') {
            $this->_header();
            $this->_input('text');
            $this->_repeater('items', [
                $this->input('name', ''),
                $this->image(prefix: ''),
            ], true);
        } else if ($this->slug == 'aluminum-glass-partitions_9') {
            $this->_input('header.1');
            $this->_input('header.2');
            $this->_image();
            $this->_textarea('text');
            $this->_fieldset('variants', [
                $this->input('variants.header'),
                $this->repeater('variants.items', [
                    $this->image(prefix: ''),
                    $this->input('title', ''),
                    $this->input('subtitle', ''),
                ]),
            ]);
        } else if ($this->slug == 'aluminum-glass-partitions_10') {
            $this->_header();
            $this->_image();
            $this->_repeater('items', [
                $this->image(prefix: ''),
                $this->input('name', ''),
                $this->toggle('1_4_glass', ''),
                $this->toggle('3_8_glass', ''),
            ], true);
        } else if ($this->slug == 'aluminum-glass-partitions_11') {
            $this->_header();

            $this->_repeater('items', [
                $this->input('name', ''),
                $this->textarea('description', ''),
                $this->image(prefix: ''),
            ], true);
        } else if ($this->slug == 'aluminum-glass-partitions_12') {
            $this->_header();
            $this->_richEditor('content');
        }
    }

    protected function formFramelessSlidingGlassWall(): void
    {
        if ($this->slug == 'frameless-sliding-glass-wall_1') {
            $this->_fieldset('Header', [
                $this->input('header.1'),
                $this->input('header.2'),
                $this->input('header.3'),
            ]);
            $this->_textarea('description');
            $this->_image();
            $this->_image('image_mobile');
            $this->_points();
        } else if ($this->slug == 'frameless-sliding-glass-wall_2') {
            $this->_fieldset('Header', [
                $this->input('header.1'),
                $this->input('header.2'),
            ]);
            $this->_textarea('text');
            $this->_simpleRepeater('list', $this->textarea('text', ''), true);
            $this->_images();
        } else if ($this->slug == 'frameless-sliding-glass-wall_3') {
            $this->_keyPlace();
        } else if ($this->slug == 'frameless-sliding-glass-wall_4') {
            $this->_header();
            $this->_repeater('items', [
                $this->image(prefix: ''),
                $this->input('title', ''),
                $this->textarea('description', ''),
            ]);
        } else if ($this->slug == 'frameless-sliding-glass-wall_5') {
            $this->_tabs([
                $this->tab('Config', [
                    $this->input('title', 'content.config.'),
                    $this->repeater('sizes', [
                        $this->input('name', ''),
                        $this->input('value', ''),
                    ], prefix: 'content.config.'),
                ]),
                $this->tab('icons', [
                    $this->repeater('icons', [
                        $this->image('icon', ''),
                        $this->input('title', ''),
                        $this->input('text', ''),
                    ]),
                ]),
            ]);
        } else if ($this->slug == 'frameless-sliding-glass-wall_6') {
            $this->_header();
            $this->_repeater('items', [
                $this->image(prefix: ''),
                $this->textarea('text', ''),
            ]);
        } else if ($this->slug == 'frameless-sliding-glass-wall_7') {
            $this->_fieldset('Header', [
                $this->input('header.1'),
                $this->input('header.2'),
            ]);
            $this->_repeater('items', [
                $this->input('text', ''),
                $this->repeater('images', [
                    $this->image(prefix: ''),
                    $this->select('color', '')->options([
                        'default' => 'Default',
                        'black' => 'Black',
                    ]),
                ], true, ''),
            ], true);
        } else if ($this->slug == 'frameless-sliding-glass-wall_8') {
            $this->_fieldset('Header', [
                $this->input('header.1'),
                $this->input('header.2'),
            ]);
            $this->_fieldset('Button', [
                $this->input('button.main'),
                $this->input('button.secondary'),
            ]);
            $this->_textarea('text');
            $this->_simpleRepeater('items', $this->textarea('text', ''), true);
        } else if ($this->slug == 'frameless-sliding-glass-wall_9') {
            $this->_fieldset('Header', [
                $this->input('header.1'),
                $this->input('header.2'),
            ]);
            $this->_input('button');
            $this->_videos1();
        } else if ($this->slug == 'frameless-sliding-glass-wall_10') {
            $this->_simpleRepeater('items', $this->input('portfolio_item_code', ''), true);
        }
    }

    protected function formFramelessGlassPartitions(): void
    {
        if ($this->slug == 'frameless-glass-partitions_1') {
            $this->_hdi();
            $this->_image('image_mobile');
        } else if ($this->slug == 'frameless-glass-partitions_2') {
            $tabs = [];

            foreach (['sliding_doors', 'swing_doors'] as $str) {
                $schema = [
                    $this->fieldset('Basic', [
                        $this->input('name', "content.$str."),
                        $this->input('title', "content.$str."),
                        $this->input('subtitle', "content.$str."),
                        $this->textarea('text', "content.$str."),
                        $this->simpleRepeater('list', $this->textarea('text', ''), prefix: "content.$str."),
                        $this->image('image', "content.$str."),
                        $this->images(prefix: "content.$str."),
                    ]),
                    $this->fieldset('features', $this->_keyPlaceArr('title', prefix: "content.$str.features.")),
                ];

                if ($str === 'sliding_doors') {
                    $schema[] = $this->fieldset('profiles', [
                        $this->repeater('profiles', [
                            $this->input('title', ''),
                            $this->input('subtitle', ''),
                            $this->image(prefix: ''),
                        ], prefix: "content.$str."),
                    ]);
                    $schema[] = $this->fieldset('soft_closing', [
                        $this->input('header1', "content.$str.soft_closing."),
                        $this->input('header2', "content.$str.soft_closing."),
                        $this->image('image', "content.$str.soft_closing."),
                        $this->textarea('text', "content.$str.soft_closing."),
                        $this->simpleRepeater('features', $this->textarea('text', ''), true, prefix: "content.$str.soft_closing."),
                    ]);
                    $schema[] = $this->fieldset('configuration', [
                        $this->repeater('configuration', [
                            $this->repeater('title', [
                                $this->toggle('blue', ''),
                                $this->input('text', ''),
                            ], true, ''),
                            $this->input('text', ''),
                            $this->image(prefix: ''),
                        ], true, "content.$str."),
                    ]);
                    $schema[] = $this->fieldset('specifications', [
                        $this->repeater('specifications', [
                            $this->image(prefix: ''),
                            $this->input('title', ''),
                            $this->input('subtitle', '')->nullable(),
                        ], prefix: "content.$str.")
                    ]);
                } else {
                    $schema[] = $this->fieldset('configuration', [
                        $this->repeater('configuration', [
                            $this->input('name', ''),
                            $this->input('text', ''),
                        ], prefix: "content.$str."),
                    ]);
                }

                $tabs[] = $this->tab($str, $schema);
            }

            $this->_tabs($tabs);
        } else if ($this->slug == 'frameless-glass-partitions_3') {
            $this->_simpleRepeater('items', $this->input('portfolio_item_code', ''), true);
        }
    }

    protected function formGlassPartitionWallSystemsForHomeOrOffice(string $type): void
    {
        if ($this->slug == "glass-partition-wall-systems-for-{$type}_1") {
            $this->_header(2);
            $this->_description();
            $this->_image();
            $this->_image('image_mobile');
            $this->_points();
        } else if ($this->slug == "glass-partition-wall-systems-for-{$type}_2") {
            $this->_header(2);
            $this->_repeater('items', [
                $this->input('url', ''),
                $this->input('formId', ''),
                $this->input('label', ''),
                $this->input('labelMini', ''),
                $this->image(prefix: ''),
                $this->image('thumb', ''),
                $this->input('title', ''),
                $this->input('subtitle', ''),
                $this->textarea('description', ''),
                $this->simpleRepeater('points', $this->textarea('text', ''), true, prefix: ''),
            ]);
        } else if ($this->slug == "glass-partition-wall-systems-for-{$type}_3") {
            $this->_header(2);
            $this->_input('time');
            $this->_input('questions');
            $this->_image();
        } else if ($this->slug == "glass-partition-wall-systems-for-{$type}_4") {
            $this->_repeater('items', [
                $this->image('left', ''),
                $this->image('right', ''),
            ], true);
        } else if ($this->slug == "glass-partition-wall-systems-for-{$type}_5") {
            $this->_header();
            $this->_fieldset('Banner', [
                $this->input('header.1', 'content.banner.'),
                $this->input('header.2', 'content.banner.'),
                $this->input('button.1', 'content.banner.'),
                $this->input('button.2', 'content.banner.'),
            ]);
            $this->_repeater('items', [
                $this->input('header', ''),
                $this->textarea('text', ''),
            ], true);
        }
    }

    protected function formAbout(): void
    {
        if ($this->slug == 'about_1') {
            $this->_header();
            $this->_richEditor('content');
        } else if ($this->slug == 'about_2') {
            $this->_grid([
                $this->input('text.1'),
                $this->input('text.2'),
                $this->input('text.3'),
                $this->input('text.4'),
                $this->input('text.5')->columnSpanFull(),
            ], 2);
            $this->_image();
        } else if ($this->slug == 'about_3') {
            $this->_repeater('departments', [
                $this->input('name', ''),
                $this->input('slug', ''),
            ], true);
            $this->_repeater('people', [
                $this->input('id', ''),
                $this->input('name', ''),
                $this->image(prefix: ''),
                $this->input('position', ''),
                $this->input('department', ''),
            ], true);
        } else if ($this->slug == 'about_4') {
            $this->_header(2);
            $this->_richEditor('text');
        }
    }

    protected function formWeInstall(): void
    {
        if ($this->slug == 'we-install_header') {
            $this->_fieldset('Title', [
                $this->input('title.start'),
                $this->input('title.center'),
                $this->input('title.end')
                    ->required(false),
            ]);
            $this->_textarea('description');
            $this->_image();
            $this->_image('image_line');
            $this->_image('image_triangle');
        } else if ($this->slug == 'we-install_map') {
            $this->_input('title');
            $this->_image();
            $this->_simpleRepeater('list', $this->input('text', ''), true);
        } else if ($this->slug == 'we-install_stages') {
            $this->_input('title');
            $this->_repeater('items', [
                $this->input('title', ''),
                $this->image(prefix: ''),
            ], true);
        }
    }

    protected function formBecomeAPartner(): void
    {
        if ($this->slug == 'partnership_header') {
            $this->_fieldset('Title', [
                $this->input('title.start'),
                $this->input('title.center'),
                $this->input('title.end')
                    ->required(false),
            ]);
            $this->_textarea('description');
            $this->_input('btn_link');
            $this->_input('btn_text');
            $this->_image();
            $this->_image('image_line');
            $this->_image('image_300');
            $this->_image('image_768');
            $this->_image('image_1024');
            $this->_image('image_1536');
            $this->_image('image_1920');
        } else if ($this->slug == 'partnership_map') {
            $this->_input('title');
            $this->_input('title_blue');
            $this->_image();
            $this->_simpleRepeater('list', $this->input('text', ''), true);
        } else if ($this->slug == 'partnership_requirements') {
            $this->_input('title');
            $this->_repeater('items', [
                $this->input('title', ''),
            ]);
        } else if ($this->slug == 'partnership_installers_school') {
            $this->_input('title');
            $this->_description();
            $this->_image('image_line');
            $this->_repeater('items', [
                $this->input('title', ''),
                $this->input('title_blue', ''),
            ]);
            $this->_videos2('videos');
            $this->_fieldset('latest_block', [
                $this->input('title', 'content.latest_block.'),
                $this->image('image', 'content.latest_block.'),
            ]);
        }
    }

    protected function formContact(): void
    {
        if ($this->slug == 'contact_1') {
            $this->_header();
            $this->_input('phone');
            $this->_input('address');
            $this->_image();
        } else if ($this->slug == 'contact_2') {
            $this->_input('url');
            $this->_input('text1');
            $this->_input('text2');
        }
    }

    protected function formWeDeliver(): void
    {
        if ($this->slug == 'we-deliver_header') {
            $this->_input('title');
            $this->_description();
            $this->_image('image_line');
        } else if ($this->slug == 'we-deliver_map') {
            $this->_input('title');
            $this->_image();
            $this->_simpleRepeater('list', $this->input('text', ''), true);
        } else if ($this->slug == 'we-deliver_stages') {
            $this->_input('title');
            $this->_repeater('items', [
                $this->input('title', ''),
                $this->image(prefix: ''),
            ]);
        } else if ($this->slug == 'we-deliver_made_simple') {
            $this->_fieldset('Title', [
                $this->input('title.start'),
                $this->input('title.center'),
                $this->input('title.end')
                    ->required(false),
            ]);
            $this->_description();
            $this->_image('image_line');
            $this->_repeater('items', [
                $this->input('title', ''),
                $this->input('title_blue', ''),
                $this->image(prefix: ''),
            ]);
            $this->_videos2('videos');
        }
    }

    protected function formInstallationGuide(): void
    {
        if ($this->slug == 'installation_1') {
            $this->_header();
            $this->_description();
        }

        if ($this->slug == 'installation_2') {
            $this->_videos2();
        }

        if ($this->slug == 'installation_3') {
            $this->_repeater('items', [
                $this->input('name', ''),
                $this->input('size', ''),
                $this->input('type', ''),
                $this->input('slug', ''),
                $this->fileUpload('file', ''),
            ], true);
        }

        if ($this->slug == 'installation_4') {
            $this->_repeater('items', [
                $this->input('name', ''),
                $this->input('size', ''),
                $this->input('slug', ''),
                $this->fileUpload('file', ''),
            ], true);
        }
    }

    protected function formIronDoors(): void
    {
        if ($this->slug == 'iron-doors_1') {
            $this->_header();
            $this->_textarea('text');
            $this->_images();
        }

        if ($this->slug == 'iron-doors_2') {
            $this->_header();
            $this->_images();

            $this->_fieldset('Form', [
                $this->input('button', 'content.form.'),
                $this->repeater('finish', [
                    $this->input('title', ''),
                    $this->input('value', ''),
                    $this->image('image', ''),
                ], prefix: 'content.form.'),
                $this->repeater('glasses', [
                    $this->input('title', ''),
                    $this->input('title2', ''),
                    $this->input('value', ''),
                ], prefix: 'content.form.'),
                $this->repeater('handles', [
                    $this->input('title', ''),
                    $this->input('title2', ''),
                    $this->input('value', ''),
                    $this->image('image', ''),
                ], prefix: 'content.form.'),
                $this->fieldset('shipping', [
                    $this->input('title', 'content.form.shipping.'),
                    $this->image('image', 'content.form.shipping.'),
                ]),
                $this->repeater('functions', [
                    $this->input('title', ''),
                    $this->input('value', ''),
                ], prefix: 'content.form.'),
                $this->fieldset('Position Left', [
                    $this->input('title', 'content.form.positions.left.'),
                    $this->input('title2', 'content.form.positions.left.'),
                    $this->input('value', 'content.form.positions.left.'),
                    $this->image('image', 'content.form.positions.left.'),
                ]),
                $this->fieldset('Position Right', [
                    $this->input('title', 'content.form.positions.right.'),
                    $this->input('title2', 'content.form.positions.right.'),
                    $this->input('value', 'content.form.positions.right.'),
                    $this->image('image', 'content.form.positions.right.'),
                ]),
            ]);
        }

        if ($this->slug == 'iron-doors_3') {
            $this->_header();
            $this->_textarea('text1');
            $this->_textarea('text2');
            $this->_textarea('text3');
            $this->_repeater('blocks', [
                $this->input('header', ''),
                $this->input('items.0', '')->markAsRequired(''),
                $this->input('items.1', '')->markAsRequired(''),
                $this->input('items.2', '')->markAsRequired(''),
                $this->input('items.3', '')->markAsRequired(''),
            ], true);
        }

        if ($this->slug == 'iron-doors_4') {
            $this->_image();
            $this->_repeater('items', [
                $this->input('header', ''),
                $this->textarea('text', ''),
                $this->image(prefix: ''),
            ]);
        }

        if ($this->slug == 'iron-doors_5') {
            $this->_videos1();
            $this->_fieldset('Block 1', [
                $this->input('header', 'content.block1.'),
                $this->textarea('text', 'content.block1.'),
            ]);
            $this->_fieldset('Block 2', [
                $this->input('facebook', 'content.block2.'),
                $this->input('instagram', 'content.block2.'),
            ]);
        }
    }

    protected function formThankYou(): void
    {
        if ($this->slug == 'thank-u-page_header') {
            $this->_input('title');
            $this->_input('btn_title');
            $this->_input('btn_link');
            $this->_description();
            $this->_image();
        }
    }

    protected function formSelectProduct(): void
    {
        if ($this->slug == 'select-product_header') {
            $this->_input('title');

            $this->_repeater('items', [
                $this->input('title', ''),
                $this->input('link', ''),
                $this->image(prefix: ''),
            ], true);
        }
    }

    protected function formPrivacyPolicy(): void
    {
        if ($this->slug == 'privacy-policy_header') {
            $this->_input('title');

            $this->_richEditor('content');
        }
    }

    protected function formBlog(): void
    {
        if ($this->slug == 'blog_1') {
            $this->_header();

            $this->schema[] = $this->select('blog_id')
                ->required()
                ->searchable()
                ->getSearchResultsUsing(
                    fn(string $search): array => Blog::where('title', 'like', "%$search%")
                        ->limit(50)
                        ->pluck('title', 'id')
                        ->toArray()
                )
                ->getOptionLabelUsing(fn($value): ?string => Blog::find($value)?->title);
        }
    }

    protected function formGallery(): void
    {
        if ($this->slug == 'gallery_1') {
            $this->_header();
        }
    }

    protected function formTypicalDetails(): void
    {
        if ($this->slug == 'typical-details_1') {
            $this->_header();
            $this->_textarea('text');
            $this->_repeater('items', [
                $this->input('name', ''),
                $this->image(prefix: ''),
            ], true);
        }
    }

    protected function formCareer(): void
    {
        if ($this->slug == 'career_1') {
            $this->_header(2);
            $this->_textarea('text');
        } else if ($this->slug == 'career_2') {
            $this->_header();
            $this->_textarea('text');
            $this->_repeater('items', [
                $this->input('name', ''),
                $this->textarea('description', ''),
                $this->simpleRepeater('content', $this->richEditor('text', ''), true, prefix: ''),
            ], true);
        }
    }

    protected function formB2b(): void
    {
        if ($this->slug == 'b2b_1') {
            $this->_header();
            $this->_textarea('text');
            $this->_input('button');
            $this->_input('video');
            $this->_image();
        } else if ($this->slug == 'b2b_2') {
            $this->_input('header1');
            $this->_input('header2');
        } else if ($this->slug == 'b2b_3') {
            $this->_header();
            $this->_repeater('items', [
                $this->input('header', ''),
                $this->textarea('text', ''),
            ], true);
        } else if ($this->slug == 'b2b_4') {
            $this->_videos1();
            $this->_fieldset('Block 1', [
                $this->input('header', 'content.block1.'),
                $this->textarea('text', 'content.block1.'),
            ]);
            $this->_fieldset('Block 2', [
                $this->input('facebook', 'content.block2.'),
                $this->input('instagram', 'content.block2.'),
            ]);
        } else if ($this->slug == 'b2b_5') {
            $this->_input('url');
            $this->_input('text1');
            $this->_input('text2');
        }
    }

    protected function formModularSystem(): void
    {
        if ($this->slug == 'modular-system_1') {
            $this->_tabs([
                $this->tab('Basic', [
                    $this->input('header.1'),
                    $this->input('header.2'),
                    $this->input('button'),
                    $this->text(),
                    $this->list(),
                ]),
                $this->tab('Images', [
                    $this->image('default_image'),
                    $this->image('mobile_image'),
                ]),
            ]);
        } else if ($this->slug == 'modular-system_2') {
            $this->_header();
            $this->_input('button');
            $this->_fileUpload('video');
            $this->_text('text1');
            $this->_text('text2');
        } else if ($this->slug == 'modular-system_3') {
            $this->image();

            $this->_repeater('items', [
                $this->input('header', ''),
                $this->text(prefix: ''),
            ], true);
        } else if ($this->slug == 'modular-system_4') {
            $this->_tabs([
                $this->tab('Basic', [
                    $this->input('header'),
                    $this->input('button'),
                    $this->richEditor('text'),
                ]),
                $this->tab('Default images', [
                    $this->images('default_images'),
                ]), $this->tab('Mobile images', [
                    $this->images('mobile_images'),
                ]),
            ]);
        } else if ($this->slug == 'modular-system_5') {
            $this->_header();

            $this->_repeater('items', [
                $this->input('name', ''),
                $this->image(prefix: ''),
                $this->image('image_little', ''),
            ], true);
        }
    }

    protected function formDealership(): void
    {
        if ($this->slug == 'dealership_header') {
            $this->_input('title');
            $this->_description();
            $this->_input('btn_text');
            $this->_input('btn_link');
            $this->_image();
            $this->_image('image_line');
            $this->_image('image_300');
            $this->_image('image_768');
            $this->_image('image_1024');
            $this->_image('image_1536');
            $this->_image('image_1920');
        } else if ($this->slug == 'dealership_map') {
            $this->_input('title');
            $this->_input('title_blue');
            $this->_image();
            $this->_simpleRepeater('list', $this->input('text', ''), true);
        } else if ($this->slug == 'dealership_how_does') {
            $this->_input('title');
            $this->_description();
            $this->_image('image_line');
            $this->_repeater('items', [
                $this->input('title', ''),
                $this->image(prefix: ''),
            ], true);
        } else if ($this->slug == 'dealership_app_banner') {
            $this->_input('title');
            $this->_input('btn_text');
            $this->_input('btn_link');
            $this->_description();
            $this->_image();
        }
    }

    protected function formAluminumFramedGlassPartitions(): void
    {
        if ($this->slug == 'aluminum-framed-glass-partitions_1') {
            $this->_input('header1');
            $this->_input('header2');
            $this->_textarea('text');
            $this->_image();
            $this->_image('image_mobile');
            $this->_repeater('points', [
                $this->input('text', ''),
            ]);
        } else if ($this->slug == 'aluminum-framed-glass-partitions_2') {
            $tabs = [];

            foreach (['sliding', 'swing'] as $str) {
                $schema = [
                    $this->fieldset('Basic', [
                        $this->input('name', "content.$str."),
                        $this->input('title', "content.$str."),
                        $this->textarea('text', "content.$str."),
                        $this->simpleRepeater('list', $this->textarea('text', ''), prefix: "content.$str."),
                        $this->image('image', "content.$str."),
                    ]),
                    $this->repeater('items', [
                        $this->input('title', ''),
                        $this->input('subtitle', ''),
                        $this->image('icon', ''),
                        $this->image(prefix: ''),
                    ], prefix: "content.$str."),
                    $this->fieldset('features', $this->_keyPlaceArr('name', prefix: "content.$str.features.")),
                ];

                if ($str === 'sliding') {
                    $schema[] = $this->fieldset('profiles', [
                        $this->repeater('profiles', [
                            $this->input('title', ''),
                            $this->input('subtitle', ''),
                            $this->image(prefix: ''),
                        ], prefix: "content.$str."),
                    ]);
                    $schema[] = $this->fieldset('soft_closing', [
                        $this->input('header1', "content.$str.soft_closing."),
                        $this->input('header2', "content.$str.soft_closing."),
                        $this->textarea('text', "content.$str.soft_closing."),
                        $this->image('image', "content.$str.soft_closing."),
                        $this->simpleRepeater('features', $this->textarea('text', ''), prefix: "content.$str.soft_closing."),
                    ]);
                    $schema[] = $this->fieldset('specifications', [
                        $this->repeater('specifications', [
                            $this->image(prefix: ''),
                            $this->input('title', ''),
                            $this->input('subtitle', '')->nullable(),
                        ], prefix: "content.$str.")
                    ]);
                }

                $tabs[] = $this->tab($str, $schema);
            }

            $this->_tabs($tabs);
        } else if ($this->slug == 'aluminum-framed-glass-partitions_3') {
            $this->_repeater('items', [
                $this->image(prefix: ''),
                $this->input('title', ''),
                $this->fieldset('detail', [
                    $this->input('color', 'detail.'),
                    $this->input('pattern', 'detail.'),
                    $this->input('privacy', 'detail.'),
                ]),
            ]);
        } else if ($this->slug == 'aluminum-framed-glass-partitions_4') {
            $this->_simpleRepeater('items', $this->input('portfolio_item_code', ''),true);
        }
    }

    protected function formVideo(): void
    {
        if ($this->slug == 'video_header') {
            $this->_input('title');
            $this->_description();
        }
    }

    protected function formShowroom(): void
    {
        if ($this->slug == 'showroom_1') {
            $this->_header();
            $this->_text('text1');
            $this->_text('text2');
            $this->_fieldset('Video', [
                $this->input('video.name'),
                $this->input('video.video'),
                $this->image('video.image'),
            ]);
        }

        if ($this->slug == 'showroom_2') {
            $this->_repeater('items', [
                $this->input('header', ''),
                $this->text('text', ''),
                $this->image(prefix: ''),
            ]);
        }

        if ($this->slug == 'showroom_3') {
            $this->_repeater('items', [
                $this->input('slug', ''),
                $this->input('title', ''),
                $this->input('subtitle', ''),
                $this->image(prefix: ''),
                $this->image('image_mobile', ''),
            ]);
        }

        if ($this->slug == 'showroom_4') {
            $this->_header();
            $this->_text();
            $this->_videos2();
        }

        if ($this->slug == 'showroom_5') {
            $this->_header();
            $this->_text();
        }

        if ($this->slug == 'showroom_6') {
            $this->_markers();
        }

        if ($this->slug == 'showroom_7') {
            $this->_repeater('items', [
                $this->input('header', ''),
                $this->text('text', ''),
                $this->image(prefix: ''),
            ]);
        }

        if ($this->slug == 'showroom_8') {
            $this->_header(2);
            $this->_text();
            $this->_image();
        }
    }
}
