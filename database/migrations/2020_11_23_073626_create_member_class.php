<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberClass extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_class', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('id_member')->unsigned();
            $table->bigInteger('id_class')->unsigned();
            $table->bigInteger('id_status')->unsigned();
            $table->timestamps();

            $table->foreign('id_member')->references('id_member')->on('member')->onDelete('cascade');
            $table->foreign('id_class')->references('id_class')->on('class')->onDelete('cascade');
            $table->foreign('id_status')->references('id_status')->on('status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_class');
    }
}
