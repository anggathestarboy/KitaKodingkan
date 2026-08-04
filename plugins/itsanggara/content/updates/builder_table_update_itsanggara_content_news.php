<?php namespace ItsAnggara\Content\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateItsanggaraContentNews extends Migration
{
    public function up()
{
    Schema::table('itsanggara_content_news', function($table)
    {
        $table->string('image_url');
    });
}

public function down()
{
    Schema::table('itsanggara_content_news', function($table)
    {
        $table->dropColumn('image_url');
    });
}
}
