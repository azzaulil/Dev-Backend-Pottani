<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->bigInteger('id_member')->unsigned();
            $table->bigInteger('id_jenis_produk')->unsigned();
            $table->bigInteger('id_status')->unsigned();
            $table->integer('stok');
            $table->string('nama_produk');
            $table->integer('harga');
            $table->timestamps();

            $table->foreign('id_member')->references('id_member')->on('member')->onDelete('cascade');
            $table->foreign('id_jenis_produk')->references('id_jenis_produk')->on('jenis_produk')->onDelete('cascade');
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
        Schema::dropIfExists('produk');
    }
}
