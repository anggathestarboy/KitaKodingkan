<?php namespace ItsAnggara\Localization\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Translations extends Controller
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
        BackendMenu::setContext('ItsAnggara.Localization', 'localization', 'translations');
    }

    /**
     * Preloads the RichEditor assets so the value fields can switch between
     * textarea and rich editor via AJAX (form refresh).
     */
    public function formExtendFields($widget)
    {
        $field = new \Backend\Classes\FormField('value_id', 'Value ID');

        $this->makeFormWidget(\Backend\FormWidgets\RichEditor::class, $field, [
            'model' => $widget->model,
            'alias' => 'valueRichEditorPreload',
        ]);
    }
}
