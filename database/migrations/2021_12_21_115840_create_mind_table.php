<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMindTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mind', function (Blueprint $table) {
            //主鍵
            $table->increments('id');
            //使用者代號
            $table->integer('user_id');
            //內容
            $table->string('content', 500)->default('');
            //啟用
            $table->integer('enabled')->default(1);
            //創建及修改日期
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
        Schema::dropIfExists('mind');
    }
}
