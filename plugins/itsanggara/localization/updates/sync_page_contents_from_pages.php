<?php namespace ItsAnggara\Localization\Updates;

use Cms\Classes\Page;
use Cms\Classes\Theme;
use Winter\Storm\Database\Updates\Migration;
use ItsAnggara\Localization\Models\PageContent;

class SyncPageContentsFromPages extends Migration
{
    public function up()
    {
        if (!($theme = Theme::getActiveTheme())) {
            return;
        }

        foreach (Page::listInTheme($theme, true) as $page) {
            PageContent::createForPageIfMissing($page);
        }
    }

    public function down()
    {
        // Nothing to undo - missing records are re-created automatically.
    }
}
