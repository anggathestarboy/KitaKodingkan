<?php namespace ItsAnggara\Localization\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class AddIsActiveToPageContentsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('itsanggara_localization_page_contents') && !Schema::hasColumn('itsanggara_localization_page_contents', 'is_active')) {
            Schema::table('itsanggara_localization_page_contents', function ($table) {
                $table->boolean('is_active')->default(true)->after('slug');
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('itsanggara_localization_page_contents') && Schema::hasColumn('itsanggara_localization_page_contents', 'is_active')) {
            Schema::table('itsanggara_localization_page_contents', function ($table) {
                $table->dropColumn('is_active');
            });
        }
    }
}
