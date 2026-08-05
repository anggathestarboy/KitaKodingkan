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
                    'pagecontents' => [
                        'label'       => 'Page Contents',
                        'icon'        => 'icon-document',
                        'url'         => \Backend\Facades\Backend::url('itsanggara/localization/pagecontents'),
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
                    $value = Localization::instance()->translate($key, $locale);

                    if (Localization::instance()->isRichText($key)) {
                        return new \Twig\Markup($value, 'UTF-8');
                    }

                    return $value;
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
                'tocFromHtml'   => function ($html) {
                    $headings = [];
                    preg_match_all('/<h([23])\s+id="([^"]*)"[^>]*>(.*?)<\/h\1>/i', $html, $matches, PREG_SET_ORDER);
                    foreach ($matches as $match) {
                        $level = (int) $match[1];
                        $id = $match[2];
                        $text = strip_tags($match[3]);
                        $headings[] = [
                            'level' => $level,
                            'id'    => $id,
                            'text'  => $text,
                        ];
                    }
                    return $headings;
                },
                'processContent' => function ($html) {
                    $html = preg_replace_callback('/<h([23])([^>]*)>(.*?)<\/h\1>/is', function ($m) {
                        $tag = $m[1];
                        $attrs = trim($m[2]);
                        $text = $m[3];
                        if (preg_match('/id=["\']([^"\']+)["\']/', $attrs, $idMatch)) {
                            return $m[0];
                        }
                        $plain = strip_tags($text);
                        $slug = \Illuminate\Support\Str::slug(trim($plain));
                        return '<h' . $tag . ' id="' . $slug . '"' . $attrs . '>' . $text . '</h' . $tag . '>';
                    }, $html);
                    return $html;
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
