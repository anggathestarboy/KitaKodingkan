<?php namespace ItsAnggara\Crud\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Projects extends Controller
{
    public $implement = [
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\FormController::class,
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = ['itsanggara.crud.manage_projects'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('ItsAnggara.Crud', 'crud', 'projects');
    }
}