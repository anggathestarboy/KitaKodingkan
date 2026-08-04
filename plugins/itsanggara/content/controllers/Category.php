<?php namespace ItsAnggara\Content\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Category extends Controller
{
    public $implement = [
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\FormController::class,
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = ['itsanggara.content.manage_categories'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('ItsAnggara.Content', 'content', 'categories');
    }
}
