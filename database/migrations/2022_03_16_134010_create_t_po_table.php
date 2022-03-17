<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_po', function (Blueprint $table) {
            $table->id();
            $table->string('kode_po', 255);
            $table->date('tanggal_po');
            $table->string('nama_supplier_atau_vendor', 200);
            $table->string('cara_bayar', 8);
            $table->string('id_user');
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
        Schema::dropIfExists('t_po');
    }
}
