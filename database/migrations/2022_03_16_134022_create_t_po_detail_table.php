<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPoDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_po_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('id_item');
            $table->bigInteger('id_po'); //foreign key table_po.id
            $table->string('nama_barang', 255);
            $table->string('merk_barang', 255);
            $table->string('satuan_barang', 7);
            $table->integer('qty');
            $table->float('harga_satuan', 8, 2);
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
        Schema::dropIfExists('t_po_detail');
    }
}
