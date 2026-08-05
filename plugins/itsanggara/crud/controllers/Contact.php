<?php namespace ItsAnggara\Crud\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Contact extends Controller
{
    public $implement = [
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\FormController::class,
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = ['itsanggara.crud.manage_contacts'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('ItsAnggara.Crud', 'crud', 'contacts');
    }

    public function create()
    {
        return $this->handleError(new \Winter\Storm\Exception\ApplicationException('Manual creation disabled.'));
    }
}
