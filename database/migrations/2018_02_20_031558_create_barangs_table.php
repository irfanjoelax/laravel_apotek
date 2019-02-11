<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->increments('id_barang');
            $table->string('kode_barang',10);
            $table->string('no_batch',100);
            $table->string('nama_barang');
            $table->integer('satuan_id')->unsigned();
            $table->integer('diskon')->unsigned();
            $table->double('harga_beli');
            $table->double('harga_jual');
            $table->double('harga_resep');
            $table->integer('stok')->unsigned();
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
        Schema::dropIfExists('barangs');
    }
}
