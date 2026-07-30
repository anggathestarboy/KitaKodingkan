<?php namespace ItsAnggara\Crud\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateItsanggaraCrudProjects extends Migration
{
    public function up()
{
    Schema::create('itsanggara_crud_projects', function($table)
    {
        $table->engine = 'InnoDB';
        $table->integer('id');
        $table->string('name');
        $table->text('description');
        $table->string('image_url');
       $table->integer('category_id')->unsigned()->nullable();
      $table->foreign('project_category_id')
      ->references('id')->on('itsanggara_crud_project_categories')
      ->onDelete('cascade');
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
        $table->primary(['id']);
    });
}

public function down()
{
    Schema::dropIfExists('itsanggara_crud_projects');
}
}
