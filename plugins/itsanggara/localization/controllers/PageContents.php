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

    public function formExtendFields($form)
    {
        $h2h3Options = [
            'N'  => 'Normal',
            'H2' => 'Heading 2',
            'H3' => 'Heading 3',
        ];

        if (isset($form->fields['content'])) {
            $form->fields['content']->options = $h2h3Options;
        }
        if (isset($form->fields['content_en'])) {
            $form->fields['content_en']->options = $h2h3Options;
        }
    }
}
