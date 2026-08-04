<?php namespace ItsAnggara\Crud\Models;

use Model;

/**
 * Model
 */
class Contact extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'itsanggara_crud_contacts';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
