<?php namespace ItsAnggara\Localization\Models;

use Model;

class PageContent extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    public $table = 'itsanggara_localization_page_contents';

    public $rules = [
        'slug'       => 'required|max:255',
        'is_active'  => 'boolean',
        'title'      => 'nullable|max:255',
        'content'    => 'nullable',
        'title_en'   => 'nullable|max:255',
        'content_en' => 'nullable',
    ];

    public $fillable = ['slug', 'is_active', 'title', 'content', 'title_en', 'content_en'];

    public $uniqueIds = ['slug'];

    public static function getBySlug($slug)
    {
        return static::where('slug', $slug)->first();
    }
}
