<?php namespace ItsAnggara\Crud\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateItsanggaraCrudProjectCategories extends Migration
{
    public function up()
{
    Schema::create('itsanggara_crud_project_categories', function($table)
    {
        $table->engine = 'InnoDB';
        $table->integer('id');
        $table->string('name');
        $table->primary(['id']);
    });
}

public function down()
{
    Schema::dropIfExists('itsanggara_crud_project_categories');
}
}
