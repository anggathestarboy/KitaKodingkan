<?php namespace ItsAnggara\Localization\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class AddDescriptionColumnsToPageContentsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('itsanggara_localization_page_contents')) {
            if (!Schema::hasColumn('itsanggara_localization_page_contents', 'description')) {
                Schema::table('itsanggara_localization_page_contents', function ($table) {
                    $table->string('description', 500)->nullable()->after('title_en');
                });
            }
            if (!Schema::hasColumn('itsanggara_localization_page_contents', 'description_en')) {
                Schema::table('itsanggara_localization_page_contents', function ($table) {
                    $table->string('description_en', 500)->nullable()->after('description');
                });
            }
        }
    }

    public function down()
    {
        if (Schema::hasTable('itsanggara_localization_page_contents')) {
            if (Schema::hasColumn('itsanggara_localization_page_contents', 'description_en')) {
                Schema::table('itsanggara_localization_page_contents', function ($table) {
                    $table->dropColumn('description_en');
                });
            }
            if (Schema::hasColumn('itsanggara_localization_page_contents', 'description')) {
                Schema::table('itsanggara_localization_page_contents', function ($table) {
                    $table->dropColumn('description');
                });
            }
        }
    }
}
