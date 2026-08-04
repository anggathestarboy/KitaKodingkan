<?php namespace ItsAnggara\Crud\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateItsanggaraCrudContacts extends Migration
{
    public function up()
{
    Schema::create('itsanggara_crud_contacts', function($table)
    {
        $table->engine = 'InnoDB';
        $table->integer('id');
        $table->string('fullname', 255);
        $table->string('email', 255);
        $table->string('need', 255);
        $table->text('message');
        $table->primary(['id']);
    });
}

public function down()
{
    Schema::dropIfExists('itsanggara_crud_contacts');
}
}
