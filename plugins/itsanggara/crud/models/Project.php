<?php namespace ItsAnggara\Crud\Models;

use Model;

/**
 * Model
 */
class Project extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'itsanggara_crud_projects';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
