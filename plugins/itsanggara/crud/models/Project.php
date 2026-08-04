<?php namespace ItsAnggara\Crud\Models;

use Model;

class Project extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    public $table = 'itsanggara_crud_projects';

    public $rules = [
        'name'           => 'required|max:255',
        'description'    => 'nullable',
        'name_en'        => 'nullable|max:255',
        'description_en' => 'nullable',
        'category_id'    => 'nullable|exists:itsanggara_crud_project_categories,id',
        'image_url'      => 'nullable',
    ];

    public $fillable = ['name', 'description', 'name_en', 'description_en', 'category_id', 'image_url'];

    public $belongsTo = [
        'category' => [
            \ItsAnggara\Crud\Models\ProjectCategory::class,
            'key' => 'category_id',
        ],
    ];
}