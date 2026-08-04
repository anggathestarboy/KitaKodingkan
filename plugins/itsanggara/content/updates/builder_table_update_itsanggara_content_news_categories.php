<?php namespace ItsAnggara\Content\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateItsanggaraContentNewsCategories extends Migration
{
    public function up()
{
    Schema::table('itsanggara_content_news_categories', function($table)
    {
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    });
}

public function down()
{
    Schema::table('itsanggara_content_news_categories', function($table)
    {
        $table->dropColumn('created_at');
        $table->dropColumn('updated_at');
    });
}
}
