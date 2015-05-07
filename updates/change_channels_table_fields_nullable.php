<?php namespace Riuson\RssReader\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class ChangeChannelsTableFieldsNullable extends Migration
{

    public function up()
    {
        Schema::table('riuson_rssreader_channels', function ($table) {
            $table->string('title')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->string('language')->nullable()->change();
            $table->datetime('pubDate')->nullable()->change();
            $table->datetime('lastBuildDate')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('riuson_rssreader_channels', function ($table) {
            $table->string('title')->change();
            $table->text('description')->change();
            $table->string('language')->change();
            $table->datetime('pubDate')->change();
            $table->datetime('lastBuildDate')->change();
        });
    }

}
