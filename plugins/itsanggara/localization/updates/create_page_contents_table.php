<?php namespace ItsAnggara\Localization\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class CreatePageContentsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('itsanggara_localization_page_contents')) {
            Schema::create('itsanggara_localization_page_contents', function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('slug')->unique();
                $table->string('title')->nullable();
                $table->text('content')->nullable();
                $table->string('title_en')->nullable();
                $table->text('content_en')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('itsanggara_localization_page_contents');
    }
}
