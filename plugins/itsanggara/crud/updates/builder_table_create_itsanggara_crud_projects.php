<?php namespace ItsAnggara\Crud\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class CreateItsanggaraCrudProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('itsanggara_crud_projects', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('id')->on('itsanggara_crud_project_categories')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('itsanggara_crud_projects', function ($table) {
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('itsanggara_crud_projects');
    }
}