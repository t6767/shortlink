<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LinkKeeper extends Migration
{
    /**
     Создаем таблицу для хранения ссылок и url путей к ним
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
			$table->string('link');
			$table->string('url');
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
        Schema::dropIfExists('links');
    }
}
