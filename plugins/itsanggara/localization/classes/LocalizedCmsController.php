<?php namespace ItsAnggara\Localization\Classes;

use App;
use Cms\Classes\CmsController;

/**
 * Handles requests that carry an /en URL prefix by delegating the stripped
 * path to the regular CMS controller.
 */
class LocalizedCmsController extends \Illuminate\Routing\Controller
{
    public function run($slug = '')
    {
        App::setLocale('en');
        Localization::instance()->setCurrentLocale('en');

        return App::make(CmsController::class)->run($slug ?: '/');
    }
}
