<?php namespace Riuson\RssReader\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateChannelsTable extends Migration
{

    public function up()
    {
        Schema::create('riuson_rssreader_channels', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('url');
            $table->string('title');
            $table->text('description');
            $table->string('language');
            $table->datetime('pubDate');
            $table->datetime('lastBuildDate');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('riuson_rssreader_channels');
    }

}
