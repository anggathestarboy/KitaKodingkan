<?php namespace ItsAnggara\Content\Models;

use Model;

class Category extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    public $table = 'itsanggara_content_news_categories';

    public $rules = [
        'name'    => 'required|max:255',
        'name_en' => 'nullable|max:255',
    ];

    public $fillable = ['name', 'name_en'];

    public $hasMany = [
        'news' => \ItsAnggara\Content\Models\News::class,
    ];
}
