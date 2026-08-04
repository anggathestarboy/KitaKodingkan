<?php namespace ItsAnggara\Content\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateItsanggaraContentNews extends Migration
{
    public function up()
{
    Schema::create('itsanggara_content_news', function($table)
    {
        $table->engine = 'InnoDB';
        $table->increments('id')->unsigned();
        $table->string('title');
        $table->text('description');
        $table->string('author');
        $table->integer('category_id')->unsigned();
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    });
}

public function down()
{
    Schema::dropIfExists('itsanggara_content_news');
}
}
