<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('no_penjualan');
            $table->bigInteger('id_member');
            $table->bigInteger('id_kasir');
            $table->date('tanggal_bayar');
            $table->bigInteger('total');
            $table->bigInteger('jumlah_bayar');
            $table->bigInteger('pembeli_bayar');
            $table->bigInteger('diskon');
            $table->bigInteger('kembalian');
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
        Schema::dropIfExists('penjualans');
    }
}
