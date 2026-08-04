<?php namespace ItsAnggara\Localization;

use App;
use Event;
use Route;
use System\Classes\PluginBase;
use ItsAnggara\Localization\Classes\Localization;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Global Localization',
            'description' => 'Global ID/EN language switching with /en URL prefix.',
            'author'      => 'ItsAnggara',
            'icon'        => 'icon-globe',
        ];
    }

    public function registerPermissions()
    {
        return [
            'itsanggara.localization.manage_translations' => [
                'tab'   => 'Localization',
                'label' => 'Manage translations',
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'localization' => [
                'label'       => 'Localization',
                'url'         => \Backend\Facades\Backend::url('itsanggara/localization/translations'),
                'icon'        => 'icon-globe',
                'permissions' => ['itsanggara.localization.*'],
                'order'       => 520,

                'sideMenu' => [
                    'translations' => [
                        'label'       => 'Translations',
                        'icon'        => 'icon-language',
                        'url'         => \Backend\Facades\Backend::url('itsanggara/localization/translations'),
                        'permissions' => ['itsanggara.localization.manage_translations'],
                    ],
                ],
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Localization',
                'description' => 'Configure the default site language.',
                'category'    => 'Localization',
                'icon'        => 'icon-globe',
                'class'       => \ItsAnggara\Localization\Models\Settings::class,
                'order'       => 500,
                'keywords'    => 'language locale id en localization',
                'permissions' => ['itsanggara.localization.manage_translations'],
            ],
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                't'         => function ($key, $locale = null) {
                    return Localization::instance()->translate($key, $locale);
                },
                'localized' => function ($model, $field) {
                    return Localization::instance()->localizedValue($model, $field);
                },
                'localeUrl' => function ($url) {
                    return Localization::instance()->localizeUrl($url);
                },
            ],
            'functions' => [
                'currentLocale' => function () {
                    return Localization::instance()->getCurrentLocale();
                },
                'localeUrl'     => function ($url) {
                    return Localization::instance()->localizeUrl($url);
                },
                'switchUrl'     => function ($locale) {
                    return Localization::instance()->switchUrl($locale);
                },
            ],
        ];
    }

    public function boot()
    {
        Event::listen('cms.beforeRoute', function () {
            Route::any('en/{slug?}', 'ItsAnggara\Localization\Classes\LocalizedCmsController@run')
                ->where('slug', '(.*)?')
                ->middleware('web');
        });

        Event::listen('cms.route', function () {
            App::setLocale(Localization::instance()->getCurrentLocale());
        });
    }
}
