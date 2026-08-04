<?php namespace ItsAnggara\Crud\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateItsanggaraCrudContacts extends Migration
{
    public function up()
{
    Schema::table('itsanggara_crud_contacts', function($table)
    {
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    });
}

public function down()
{
    Schema::table('itsanggara_crud_contacts', function($table)
    {
        $table->dropColumn('created_at');
        $table->dropColumn('updated_at');
    });
}
}
