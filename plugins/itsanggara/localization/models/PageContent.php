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
