<?php namespace ItsAnggara\Localization\Models;

use Model;

class Translation extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    public $table = 'itsanggara_localization_translations';

    public $rules = [
        'group'        => 'required|max:100',
        'key'          => 'required|max:255',
        'value_id'     => 'nullable',
        'value_en'     => 'nullable',
        'is_rich_text' => 'boolean',
    ];

    public $fillable = ['group', 'key', 'value_id', 'value_en', 'is_rich_text'];

    public function filterFields($fields, $context = null)
    {
        if ($this->is_rich_text) {
            $fields->value_id->displayAs('widget', ['widget' => 'richeditor']);
            $fields->value_en->displayAs('widget', ['widget' => 'richeditor']);
        } else {
            $fields->value_id->displayAs('textarea', []);
            $fields->value_en->displayAs('textarea', []);
        }
    }

    public function getGroupOptions()
    {
        return [
            'header'  => 'Header',
            'footer'  => 'Footer',
            'hero'    => 'Hero',
            'service' => 'Service',
            'project' => 'Project',
            'blog'    => 'Blog',
            'about'   => 'About',
        ];
    }

    public function scopeFilterByGroup($query, $value)
    {
        return $query->where('group', $value);
    }
}
