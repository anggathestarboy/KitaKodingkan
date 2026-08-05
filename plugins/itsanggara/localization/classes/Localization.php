<?php namespace ItsAnggara\Localization\Classes;

use App;
use Request;
use ItsAnggara\Localization\Models\Translation;
use ItsAnggara\Localization\Models\Settings;

/**
 * Central service handling the active locale, static translations and
 * localized values for model attributes.
 */
class Localization
{
    /**
     * @var Localization|null Singleton instance.
     */
    protected static $instance = null;

    /**
     * @var string Locale codes that get an URL prefix.
     */
    protected $prefixedLocales = ['en'];

    /**
     * @var array Cached translations for the current request.
     */
    protected $translationCache = [];

    /**
     * @var string|null Currently active locale.
     */
    protected $currentLocale = null;

    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Returns the default locale (no URL prefix).
     */
    public function getDefaultLocale()
    {
        $default = Settings::get('default_locale', 'id');

        return $default ?: 'id';
    }

    /**
     * Returns the locale for the current request, resolved from the URL.
     */
    public function getCurrentLocale()
    {
        if ($this->currentLocale !== null) {
            return $this->currentLocale;
        }

        $path = '/' . trim((string) Request::path(), '/');
        $firstSegment = ltrim($path, '/');
        $firstSegment = explode('/', $firstSegment)[0];

        if (in_array($firstSegment, $this->prefixedLocales)) {
            return $this->currentLocale = $firstSegment;
        }

        return $this->currentLocale = $this->getDefaultLocale();
    }

    /**
     * Forces the current locale.
     */
    public function setCurrentLocale($locale)
    {
        return $this->currentLocale = $locale;
    }

    /**
     * Whether the given locale is the active one.
     */
    public function isActiveLocale($locale)
    {
        return $this->getCurrentLocale() === $locale;
    }

    /**
     * Translates a static string key for the active locale, falling back to
     * the default locale and finally to the key itself.
     */
    public function translate($key, $locale = null)
    {
        $locale = $locale ?: $this->getCurrentLocale();
        $default = $this->getDefaultLocale();

        if ($row = $this->findTranslation($key)) {
            $column = $this->valueColumnFor($locale);

            if (!empty($row->{$column})) {
                return $row->{$column};
            }

            if ($locale !== $default) {
                $defaultColumn = $this->valueColumnFor($default);

                if (!empty($row->{$defaultColumn})) {
                    return $row->{$defaultColumn};
                }
            }
        }

        return $key;
    }

    /**
     * Whether the given translation key should be rendered as rich text.
     */
    public function isRichText($key)
    {
        $row = $this->findTranslation($key);

        return $row ? (bool) $row->is_rich_text : false;
    }

    /**
     * Returns the localized value for a model attribute.
     *
     * When the active locale differs from the default and a translated
     * column exists (field_<locale>) with a non-empty value, that value is
     * returned. Otherwise the original field is used.
     */
    public function localizedValue($model, $field)
    {
        if (!$model || !$field) {
            return $field;
        }

        $locale = $this->getCurrentLocale();
        $default = $this->getDefaultLocale();

        if ($locale !== $default) {
            $translatedField = $field . '_' . $locale;

            if (array_key_exists($translatedField, $model->getAttributes())) {
                $value = trim((string) $model->{$translatedField});

                if ($value !== '') {
                    return $model->{$translatedField};
                }
            }
        }

        return $model->{$field};
    }

    /**
     * Prefixes a URL with the active locale when needed.
     */
    public function localizeUrl($url)
    {
        $locale = $this->getCurrentLocale();

        if ($locale === $this->getDefaultLocale()) {
            return $this->stripPrefix($url);
        }

        if (strpos($url, '/' . $locale) === 0) {
            return $url;
        }

        return '/' . $locale . $this->normalizePath($url);
    }

    /**
     * Returns the URL that switches to the requested locale while keeping
     * the current page path.
     */
    public function switchUrl($locale)
    {
        $path = '/' . trim((string) Request::path(), '/');
        $default = $this->getDefaultLocale();

        if ($locale === $default) {
            return $this->stripPrefix($path) ?: '/';
        }

        $clean = $this->stripPrefix($path);

        return '/' . $locale . $this->normalizePath($clean);
    }

    /**
     * Removes a locale prefix from the given path.
     */
    protected function stripPrefix($path)
    {
        foreach ($this->prefixedLocales as $prefix) {
            $search = '/' . $prefix . '/';

            if ($path === '/' . $prefix) {
                return '/';
            }

            if (strpos($path, $search) === 0) {
                return substr($path, strlen($search) - 1);
            }
        }

        return $path;
    }

    /**
     * Ensures a path starts with exactly one leading slash.
     */
    protected function normalizePath($path)
    {
        return '/' . ltrim($path, '/');
    }

    /**
     * Finds a translation row for the given key, with a per-request cache.
     */
    protected function findTranslation($key)
    {
        if (array_key_exists($key, $this->translationCache)) {
            return $this->translationCache[$key];
        }

        if (strpos($key, '.') !== false) {
            [$group, $keyOnly] = explode('.', $key, 2);
            $row = Translation::where('group', $group)->where('key', $keyOnly)->first();
        } else {
            $row = Translation::where('key', $key)->first();
        }

        return $this->translationCache[$key] = $row;
    }

    /**
     * Maps a locale to its value column on the translations table.
     */
    protected function valueColumnFor($locale)
    {
        $columns = [
            'id' => 'value_id',
            'en' => 'value_en',
        ];

        return $columns[$locale] ?? 'value_' . $locale;
    }
}
