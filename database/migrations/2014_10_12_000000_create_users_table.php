<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            //主鍵
            $table->increments('id');
            //姓名
            $table->string('name', 50);
            //帳號
            $table->string('account', 50)->unique();
            //密碼
            $table->string('password', 60);
            //類型
            $table->integer('type')->default(0);
            //性別
            $table->tinyInteger('sex')->default(0);
            //身高
            $table->decimal('height')->default(0);
            //體重
            $table->decimal('weight')->default(0);
            //興趣
            $table->string('interest', 100)->default('');
            //介紹
            $table->string('introduce', 500)->default('');
            //圖片
            $table->string('picture', 50)->default('');
            //啟用
            $table->tinyInteger('enabled')->default(1);
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
        Schema::dropIfExists('users');
    }
}
