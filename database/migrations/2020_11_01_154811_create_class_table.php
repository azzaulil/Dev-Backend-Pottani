<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class', function (Blueprint $table) {
            $table->id('id_class');
            $table->string('nama');
            $table->string('poster')->nullable();
            $table->string('deskripsi');
            $table->string('link_video');
            $table->integer('biaya');
            $table->bigInteger('id_kategori')->unsigned();
            $table->bigInteger('id_status')->unsigned();
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
        Schema::dropIfExists('class');
    }
}
