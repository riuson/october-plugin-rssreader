<?php
namespace Riuson\RssReader\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddChannelsDateFormat extends Migration
{

    public function up()
    {
        Schema::table('riuson_rssreader_channels', function ($table) {
            $table->string('date_format')->nullable();
        });
    }

    public function down()
    {
        Schema::table('riuson_rssreader_channels', function ($table) {
            $table->dropColumn('date_format');
        });
    }
}
