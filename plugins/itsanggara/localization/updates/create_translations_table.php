<?php namespace ItsAnggara\Localization\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class CreateTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('itsanggara_localization_translations', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('group')->default('header');
            $table->string('key');
            $table->text('value_id')->nullable();
            $table->text('value_en')->nullable();
            $table->timestamps();

            $table->unique(['group', 'key']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('itsanggara_localization_translations');
    }
}
