<?php namespace ItsAnggara\Content\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateItsanggaraContentNewsCategories extends Migration
{
    public function up()
{
    Schema::create('itsanggara_content_news_categories', function($table)
    {
        $table->engine = 'InnoDB';
        $table->increments('id')->unsigned();
        $table->string('name');
    });
}

public function down()
{
    Schema::dropIfExists('itsanggara_content_news_categories');
}
}
