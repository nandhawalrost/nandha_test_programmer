<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnsTPoDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_po', function (Blueprint $table) {
            $table->date('tanggal_po')->nullable()->change();
            $table->string('nama_supplier_atau_vendor', 200)->nullable()->change();
            $table->string('cara_bayar', 8)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
