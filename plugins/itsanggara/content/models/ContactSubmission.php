<?php namespace ItsAnggara\Content\Models;

use Model;

class ContactSubmission extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    public $table = 'itsanggara_content_contact_submissions';

    public $rules = [
        'name'         => 'required|max:255',
        'email'        => 'required|email|max:255',
        'service_need' => 'required|max:255',
        'message'      => 'required',
    ];

    public $fillable = ['name', 'email', 'service_need', 'message'];
}
