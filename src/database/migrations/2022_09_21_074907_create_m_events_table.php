<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMEventsTable extends Migration
{
    /**
     * Run the migrations.
     * イベント
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_events', function (Blueprint $table) {
            $table->id();
            $table->string('titel',255)->comment("タイトル");
            $table->text('content')->comment("内容");
            $table->dateTime('date_time')->comment("日時");
            $table->boolean('del_flg')->comment("無効化");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_events');
    }
}
