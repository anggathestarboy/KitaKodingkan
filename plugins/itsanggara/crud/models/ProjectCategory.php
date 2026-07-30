<?php namespace ItsAnggara\Crud\Models;

use Model;

/**
 * Model
 */
class ProjectCategory extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'itsanggara_crud_project_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
