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
        'fullname' => 'required|max:255',
        'email'    => 'required|email|max:255',
        'need'     => 'required|max:255',
        'message'  => 'required',
    ];

    /**
     * @var array Fillable attributes
     */
    public $fillable = ['fullname', 'email', 'need', 'message'];
}
