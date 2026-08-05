<?php namespace ItsAnggara\Localization\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class AddIsRichTextToTranslationsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('itsanggara_localization_translations')) {
            if (!Schema::hasColumn('itsanggara_localization_translations', 'is_rich_text')) {
                Schema::table('itsanggara_localization_translations', function ($table) {
                    $table->boolean('is_rich_text')->default(false)->after('value_en');
                });
            }
        }
    }

    public function down()
    {
        if (Schema::hasTable('itsanggara_localization_translations')) {
            if (Schema::hasColumn('itsanggara_localization_translations', 'is_rich_text')) {
                Schema::table('itsanggara_localization_translations', function ($table) {
                    $table->dropColumn('is_rich_text');
                });
            }
        }
    }
}
