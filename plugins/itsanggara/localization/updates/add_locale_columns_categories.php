<?php namespace ItsAnggara\Localization\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class AddLocaleColumnsToCategories extends Migration
{
    public function up()
    {
        Schema::table('itsanggara_content_news_categories', function ($table) {
            $table->string('name_en')->nullable();
        });

        Schema::table('itsanggara_crud_project_categories', function ($table) {
            $table->string('name_en')->nullable();
        });
    }

    public function down()
    {
        Schema::table('itsanggara_content_news_categories', function ($table) {
            $table->dropColumn(['name_en']);
        });

        Schema::table('itsanggara_crud_project_categories', function ($table) {
            $table->dropColumn(['name_en']);
        });
    }
}
