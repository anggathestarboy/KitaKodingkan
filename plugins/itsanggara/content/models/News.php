<?php namespace ItsAnggara\Content\Models;

use Model;

class News extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    public $table = 'itsanggara_content_news';

    public $rules = [
        'title'          => 'required|max:255',
        'description'    => 'nullable',
        'title_en'       => 'nullable|max:255',
        'description_en' => 'nullable',
        'author'         => 'nullable|max:255',
        'category_id'    => 'nullable|exists:itsanggara_content_news_categories,id',
        'image_url'      => 'nullable',
    ];

    public $fillable = ['title', 'description', 'title_en', 'description_en', 'author', 'category_id', 'image_url'];

    public $belongsTo = [
        'category' => [
            \ItsAnggara\Content\Models\Category::class,
            'key' => 'category_id',
        ],
    ];
}
