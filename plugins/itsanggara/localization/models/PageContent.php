<?php namespace ItsAnggara\Localization\Models;

use Model;

class PageContent extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    public $table = 'itsanggara_localization_page_contents';

    public $rules = [
        'slug'            => 'required|max:255',
        'is_active'       => 'boolean',
        'title'           => 'nullable|max:255',
        'content'         => 'nullable',
        'title_en'        => 'nullable|max:255',
        'content_en'      => 'nullable',
        'description'     => 'nullable|max:500',
        'description_en'  => 'nullable|max:500',
    ];

    public $fillable = ['slug', 'is_active', 'title', 'content', 'title_en', 'content_en', 'description', 'description_en'];

    public $uniqueIds = ['slug'];

    public static function getBySlug($slug)
    {
        return static::where('slug', $slug)->first();
    }

    /**
     * Derives the PageContent slug that belongs to the given CMS page.
     * The URL path is preferred so pages whose file name differs from their
     * URL (e.g. projects.htm -> /proyek) still resolve to the seeded slug.
     * System and route-parameter pages are skipped.
     */
    public static function slugForPage($page)
    {
        if (!$page) {
            return null;
        }

        $fileName = trim((string) $page->getBaseFileName());
        if (in_array($fileName, ['404', 'error'])) {
            return null;
        }

        $url = trim((string) $page->url, '/');

        if ($url !== '' && strpos($url, ':') === false) {
            return $url;
        }

        if ($url === '') {
            return $fileName ?: null;
        }

        return null;
    }

    /**
     * Resolves the CMS page this record belongs to, using the slug as the URL
     * path first and falling back to the page file name.
     *
     * @return \Cms\Classes\Page|null
     */
    public function getPage()
    {
        $slug = trim((string) $this->slug, '/');
        if ($slug === '') {
            return null;
        }

        $theme = \Cms\Classes\Theme::getEditTheme();
        if (!$theme) {
            $theme = \Cms\Classes\Theme::getActiveTheme();
        }
        if (!$theme) {
            return null;
        }

        $pages = \Cms\Classes\Page::inTheme($theme);

        $page = $pages->where('url', '/' . $slug)->first();

        return $page ?: $pages->find($slug . '.htm');
    }

    /**
     * Creates a PageContent record for the given CMS page when it does not
     * exist yet. Indonesian title and description are inherited from the CMS
     * page; English fields are left empty for manual translation. Existing
     * records are never modified.
     */
    public static function createForPageIfMissing($page)
    {
        $slug = static::slugForPage($page);

        if (!$slug || static::where('slug', $slug)->exists()) {
            return null;
        }

        $record = new static;
        $record->slug = $slug;
        $record->is_active = true;
        $record->title = $page->title ?: null;
        $record->description = $page->description ?: ($page->meta_description ?: null);
        $record->save();

        return $record;
    }

    /**
     * Resolves the PageContent record that belongs to the given CMS page.
     *
     * The slug stored in the database does not always match the page's file
     * name (e.g. projects.htm maps to slug "proyek"), so both the base file
     * name and the URL path are tried.
     */
    public static function resolveForPage($page)
    {
        if (!$page) {
            return null;
        }

        $candidates = [];

        $baseFileName = trim((string) $page->baseFileName);
        if ($baseFileName !== '') {
            $candidates[] = $baseFileName;
        }

        $url = trim((string) $page->url, '/');
        if ($url !== '') {
            $candidates[] = $url;
        }

        foreach (array_unique($candidates) as $slug) {
            $row = static::where('slug', $slug)->first();
            if ($row) {
                return $row;
            }
        }

        return null;
    }
}
