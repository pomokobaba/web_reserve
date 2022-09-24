<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMManagersTable extends Migration
{
    /**
     * Run the migrations.
     * 担当者
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_managers', function (Blueprint $table) {
            $table->id();
            $table->string('nama',255)->comment('氏名');
            $table->string('email',255)->comment('email');
            $table->boolean('del_flg')->comment('無効化');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_managers');
    }
}
