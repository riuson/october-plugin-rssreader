<?php namespace Riuson\RssReader\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class ChangeItemsTableFieldsNullable extends Migration
{

    public function up()
    {
        Schema::table('riuson_rssreader_items', function ($table) {
            $table->string('title')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->string('link')->nullable()->change();
            $table->datetime('pubDate')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('riuson_rssreader_items', function ($table) {
            $table->string('title')->change();
            $table->text('description')->change();
            $table->string('link')->change();
            $table->datetime('pubDate')->change();
        });
    }

}
