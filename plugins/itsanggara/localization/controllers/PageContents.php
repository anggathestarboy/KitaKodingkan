<?php namespace ItsAnggara\Localization\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class PageContents extends Controller
{
    public $implement = [
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\FormController::class,
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = ['itsanggara.localization.manage_translations'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('ItsAnggara.Localization', 'localization', 'pagecontents');
    }

    public function create()
    {
        return $this->handleError(new \Winter\Storm\Exception\ApplicationException('Creating new content is disabled. Only editing existing content is allowed.'));
    }
}
