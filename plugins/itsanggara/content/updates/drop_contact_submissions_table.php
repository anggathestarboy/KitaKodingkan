<?php namespace ItsAnggara\Content\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class DropContactSubmissionsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('itsanggara_content_contact_submissions');
    }

    public function down()
    {
        if (!Schema::hasTable('itsanggara_content_contact_submissions')) {
            Schema::create('itsanggara_content_contact_submissions', function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name');
                $table->string('email');
                $table->string('service_need');
                $table->text('message');
                $table->timestamps();
            });
        }
    }
}
