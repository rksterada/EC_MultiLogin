<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 紐づくモデル名_id
        // データの削除を行う際、外部キーで紐づいている場合、cascadeを用いて両方削除する
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade'); 
            $table->string('name'); 
            $table->text('information'); 
            $table->string('filename'); 
            $table->boolean('is_selling');
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
        Schema::dropIfExists('shops');
    }
}
