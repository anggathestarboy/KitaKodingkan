<?php namespace ItsAnggara\Localization\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class AddLocaleColumnsToProjects extends Migration
{
    public function up()
    {
        Schema::table('itsanggara_crud_projects', function ($table) {
            $table->string('name_en')->nullable();
            $table->text('description_en')->nullable();
        });
    }

    public function down()
    {
        Schema::table('itsanggara_crud_projects', function ($table) {
            $table->dropColumn(['name_en', 'description_en']);
        });
    }
}
