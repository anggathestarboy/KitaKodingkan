<?php namespace ItsAnggara\Localization\Models;

use Model;

class Translation extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    public $table = 'itsanggara_localization_translations';

    public $rules = [
        'group'    => 'required|max:100',
        'key'      => 'required|max:255',
        'value_id' => 'nullable',
        'value_en' => 'nullable',
    ];

    public $fillable = ['group', 'key', 'value_id', 'value_en'];
}
