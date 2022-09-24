<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLEventManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_event_managers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('m_events_id')->constrained()->comment('イベントID')->onDelete('cascade');
            $table->foreignId('m_managers_id')->constrained()->comment('イベント管理者ID')->onDelete('cascade');
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
        Schema::dropIfExists('l_event_managers');
    }
}
