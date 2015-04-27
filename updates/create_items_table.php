<?php namespace Riuson\RssReader\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateItemsTable extends Migration
{

    public function up()
    {
        Schema::create('riuson_rssreader_items', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('channel_id');
            $table->string('title');
            $table->string('link');
            $table->text('description');
            $table->datetime('pubDate');
            $table->string('guid');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('riuson_rssreader_items');
    }

}
