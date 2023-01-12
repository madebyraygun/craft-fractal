<?php
/**
 * Yii Application Config
 *
 * Edit this file at your own risk!
 *
 * The array returned by this file will get merged with
 * vendor/craftcms/cms/src/config/app.php and app.[web|console].php, when
 * Craft's bootstrap script is defining the configuration for the entire
 * application.
 *
 * You can define custom modules and system components, and even override the
 * built-in system components.
 *
 * If you want to modify the application config for *only* web requests or
 * *only* console requests, create an app.web.php or app.console.php file in
 * your config/ folder, alongside this one.
 */

use craft\helpers\App;

return [
    'id' => App::env('CRAFT_APP_ID') ?: 'CraftCMS',
    'modules' => [
        'cp-body-classes' => \modules\cpbodyclasses\CpBodyClasses::class,
        'page-blocks' => \modules\pageblocks\PageBlocks::class,
        'layout-context' => \modules\layoutcontext\LayoutContext::class,
        'page-context' => \modules\pagecontext\PageContext::class,
    ],
    'bootstrap' => ['cp-body-classes', 'page-blocks', 'layout-context', 'page-context'],
];
