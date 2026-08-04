<?php namespace ItsAnggara\Localization\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class AddLocaleColumnsToNews extends Migration
{
    public function up()
    {
        Schema::table('itsanggara_content_news', function ($table) {
            $table->string('title_en')->nullable();
            $table->text('description_en')->nullable();
        });
    }

    public function down()
    {
        Schema::table('itsanggara_content_news', function ($table) {
            $table->dropColumn(['title_en', 'description_en']);
        });
    }
}
