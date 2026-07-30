<?php namespace ItsAnggara\Crud\Models;

use Model;

class ProjectCategory extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    public $table = 'itsanggara_crud_project_categories';

    public $rules = [
        'name' => 'required|max:255',
    ];

    public $fillable = ['name'];

    public $hasMany = [
        'projects' => \ItsAnggara\Crud\Models\Project::class,
    ];
}